<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RecruitersController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Get all users (recruiters) with pagination and search
            $recruiters = User::query()
                ->when($request->has('search'), function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong while fetching recruiters.');
        }

        return view('admin.recruiters.index', compact('recruiters'));
    }

    public function create()
    {
        return view('admin.recruiters.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
            ]);

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            return redirect()->route('admin.recruiters.index')
                ->with('success', 'Recruiter created successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error creating recruiter.');
        }
    }

    public function show($id)
    {
        try {
            $recruiter = User::find($id);

            if (!$recruiter) {
                return back()->with('error', 'Recruiter not found.');
            }

            return view('admin.recruiters.show', compact('recruiter'));

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong while loading recruiter details.');
        }
    }

    public function edit($id)
    {
        try {
            $recruiter = User::findOrFail($id);
            return view('admin.recruiters.edit', compact('recruiter'));

        } catch (\Exception $e) {
            return back()->with('error', 'Recruiter not found.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $recruiter = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
            ]);

            $recruiter->update($validated);

            return redirect()->route('admin.recruiters.index')
                ->with('success', 'Recruiter updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error updating recruiter.');
        }
    }

    public function destroy($id)
    {
        try {
            $recruiter = User::findOrFail($id);
            $recruiter->delete();

            return redirect()->route('admin.recruiters.index')
                ->with('success', 'Recruiter deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting recruiter.');
        }
    }
}