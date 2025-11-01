<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Recruiter;
use App\Models\Category;
use App\Models\Location;
use App\Models\State;
use App\Models\City;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $categories = Category::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();
        $states     = State::orderBy('name')->get();
        $recruiter = Recruiter::where('user_id', auth()->id())->first();

        $cities = collect();
        if ($recruiter && $recruiter->state_id) {
            $cities = City::where('state_id', $recruiter->state_id)->orderBy('name')->get();
        }
        return view('profile.edit', [
            'user' => $request->user(),
            'categories' => $categories,
            'locations' => $locations,
            'recruiter' => $recruiter,
            'states'      => $states,
            'cities'      => $cities,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function getCities(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)
                    ->orderBy('name')
                    ->get(['id', 'name']);
        return response()->json($cities);
    }

}
