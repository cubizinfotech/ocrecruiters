<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Recruiter;
use App\Models\Category;
use App\Models\Location;
use App\Models\Resume;
use App\Models\State;
use App\Models\City;

class RecruiterController extends Controller
{
    public function index(Request $request)
    {
        $query = Recruiter::query()->with(['category', 'location', 'resume']);

        // Filter by name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by state and city
        if ($request->filled('state_city')) {
            $ids = explode(',', $request->state_city);
            if (count($ids) == 2) {
                $query->where('state_id', $ids[0])->where('city_id', $ids[1]);
            } else {
                $query->where('city_id', $ids[0]);
            }
        }

        switch ($request->sort) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'rating_desc':
                $query->orderBy('rating', 'desc');
                break;
            case 'rating_asc':
                $query->orderBy('rating', 'asc');
                break;
            default:
                $query->orderBy('id', 'desc');
        }

        // Get paginated recruiters
        $perPage = $request->input('per_page', 5);
        $recruiters = $query->paginate($perPage);

        // Master dropdowns
        $categories = Category::orderBy('name')->get();
        $cities = City::with('state')->orderBy('name')->get();

        $categoryOptions = [];
        foreach ($categories as $category) {
            $categoryOptions[$category->id] = $category->name;
        }

        $locationOptions = [];
        foreach ($cities as $city) {
            $stateName = isset($city->state->name) ? $city->state->name : '';
            $stateId = isset($city->state->id) ? $city->state->id : '';

            $key = $stateId ? $stateId . ',' . $city->id : $city->id;
            $value = $stateName ? $stateName . ', ' . $city->name : $city->name;

            $locationOptions[$key] = $value;
        }

        // Count total
        $total = $recruiters->total();

        return view('welcome', compact('recruiters', 'total', 'locationOptions', 'categoryOptions'));
    }

    public function show($id, Request $request)
    {

        $recruiter = Recruiter::with(['category', 'location', 'resume'])->where('user_id', $id)->firstOrFail();

        return view('recruiters.show', compact('recruiter'));
    }

    public function edit()
    {
        $categories = Category::orderBy('name')->get();
        $locations = Location::orderBy('name')->get();

        $recruiter = Recruiter::where('user_id', auth()->id())->first();
        return view('recruiters.edit', compact('recruiter', 'categories', 'locations'));
    }


    public function resumeEdit()
    {
        $resume = Resume::where('user_id', auth()->id())->first();

        $workHistory = $educationData = $certData = [];

        if (!empty($resume->experience)) {
            $decodedWork = json_decode($resume->experience, true);
            $workHistory = is_array($decodedWork) ? $decodedWork : [];
        }

        if (!empty($resume->education)) {
            $decodedEdu = json_decode($resume->education, true);
            $educationData = is_array($decodedEdu) ? $decodedEdu : [];
        }

        if (!empty($resume->certifications)) {
            $decodedCert = json_decode($resume->certifications, true);
            $certData = is_array($decodedCert) ? $decodedCert : [];
        }

        $states = State::orderBy('name')->get();
        $stateOptions = [];
        foreach ($states as $state) {
            $stateOptions[] = ['id' => $state->id, 'name' => $state->name];
        }
        $cities = City::orderBy('name')->get();
        $citiyOptions = [];
        foreach ($cities as $city) {
            $citiyOptions[] = ['id' => $city->id, 'state_id' => $city?->state->id, 'name' => $city->name];
        }

        return view('recruiters.edit', compact('resume', 'workHistory', 'educationData', 'certData', 'stateOptions', 'citiyOptions'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'rating' => 'nullable|integer|min:0|max:5',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $recruiter = Recruiter::where('user_id', auth()->id())->first();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($recruiter && $recruiter->logo && Storage::exists('public/' . $recruiter->logo)) {
                Storage::delete('public/' . $recruiter->logo);
            }
            $validated['logo'] = $request->file('logo')->store('recruiter-logos', 'public');
        }

        if ($recruiter) {
            $recruiter->update($validated);
        } else {
            $validated['user_id'] = auth()->id();
            Recruiter::create($validated);
        }

        return back()->with('success', 'Recruiter profile updated successfully.');
    }

    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|digits_between:8,15',
            'address' => 'required|string',
            'summary' => 'nullable|string',
            'work' => 'array',
            'work.*.position' => 'nullable|string|max:255',
            'work.*.start_date' => 'nullable|date',
            'work.*.end_date' => 'nullable|date',
            'work.*.company_name' => 'nullable|string|max:255',
            'work.*.city' => 'nullable|string|max:255',
            'work.*.city_name' => 'nullable|string|max:255',
            'work.*.state' => 'nullable|string|max:255',
            'work.*.state_name' => 'nullable|string|max:255',
            'work.*.company_summary' => 'nullable|string',
            'education' => 'nullable|array',
            'education.*.degree' => 'nullable|string|max:255',
            'education.*.field' => 'nullable|string|max:255',
            'education.*.school' => 'nullable|string|max:255',
            'education.*.city' => 'nullable|string|max:255',
            'education.*.city_name' => 'nullable|string|max:255',
            'education.*.state' => 'nullable|string|max:255',
            'education.*.state_name' => 'nullable|string|max:255',
            'certifications' => 'nullable|array',
            'certifications.*.cert' => 'nullable|string|max:255',
            'certifications.*.field' => 'nullable|string|max:255',
            'certifications.*.institution' => 'nullable|string|max:255',
            'certifications.*.city' => 'nullable|string|max:255',
            'certifications.*.city_name' => 'nullable|string|max:255',
            'certifications.*.state' => 'nullable|string|max:255',
            'certifications.*.state_name' => 'nullable|string|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:100',
            'resume_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:3072',
            'logo_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'banner_file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $experience = json_encode(array_values($validated['work'] ?? []));

        $education = json_encode(array_values($validated['education'] ?? []));

        $certifications = json_encode(array_values($validated['certifications'] ?? []));

        $skills = json_encode($validated['skills'] ?? []);

        $resume = Resume::where('user_id', auth()->id())->first();

        $filePath = $logoPath = $bannerPath = null;
        $originalFileName = $logoName = $bannerName = null;
        if ($request->hasFile('resume_file')) {
            $originalFileName = $request->file('resume_file')->getClientOriginalName();
            $filePath = $request->file('resume_file')->store('resumes', 'public');
        }
        if ($request->hasFile('logo_file')) {
            $logo = $request->file('logo_file');
            $logoName = $logo->getClientOriginalName();

            [$width, $height] = getimagesize($logo);
            if ($width < 100 || $height < 100) {
                return back()->withErrors(['logo_file' => 'Logo must be at least 100x100 pixels.']);
            }

            $logoPath = $logo->store('resumes/logos', 'public');
        }

        if ($request->hasFile('banner_file')) {
            $banner = $request->file('banner_file');
            $bannerName = $banner->getClientOriginalName();

            [$width, $height] = getimagesize($banner);
            if ($width < 1200 || $height < 400) {
                return back()->withErrors(['banner_file' => 'Banner must be at least 1200x400 pixels.']);
            }

            $bannerPath = $banner->store('resumes/banners', 'public');
        }

        if ($resume) {
            if ($filePath && $resume->file_path && Storage::disk('public')->exists($resume->file_path)) {
                Storage::disk('public')->delete($resume->file_path);
            }
            if ($logoPath && $resume->logo_path && Storage::disk('public')->exists($resume->logo_path)) {
                Storage::disk('public')->delete($resume->logo_path);
            }
            if ($bannerPath && $resume->banner_path && Storage::disk('public')->exists($resume->banner_path)) {
                Storage::disk('public')->delete($resume->banner_path);
            }
            $resume->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'summary' => $validated['summary'],
                'experience' => $experience,
                'education' => $education,
                'certifications' => $certifications,
                'skills' => $skills,
                'file_path' => $filePath ?? $resume->file_path,
                'original_file_name' => $originalFileName ?? $resume->original_file_name,
                'logo_path' => $logoPath ?? $resume->logo_path ?? null,
                'logo_original_name' => $logoName ?? $resume->logo_original_name ?? null,
                'banner_path' => $bannerPath ?? $resume->banner_path ?? null,
                'banner_original_name' => $bannerName ?? $resume->banner_original_name ?? null,
            ]);
        } else {
            Resume::create([
                'user_id' => auth()->id(),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'summary' => $validated['summary'],
                'experience' => $experience,
                'education' => $education,
                'certifications' => $certifications,
                'skills' => $skills,
                'file_path' => $filePath,
                'original_file_name' => $originalFileName,
                'logo_path' => $logoPath,
                'logo_original_name' => $logoName,
                'banner_path' => $bannerPath,
                'banner_original_name' => $bannerName,
            ]);
        }

        return back()->with('success', 'Resume saved successfully!');
    }

    public function ajaxCategorySearch(Request $request)
    {
        $query = Category::query();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $categories = $query->orderBy('name')
            ->paginate(10);

        return response()->json([
            'data' => $categories->items(),
            'pagination' => [
                'more' => $categories->hasMorePages()
            ]
        ]);
    }

    public function ajaxLocationSearch(Request $request)
    {
        $query = Location::query();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $location = $query->orderBy('name')
            ->paginate(10);

        return response()->json([
            'data' => $location->items(),
            'pagination' => [
                'more' => $location->hasMorePages()
            ]
        ]);
    }

    public function ajaxStateSearch(Request $request)
    {
        $query = State::query();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $state = $query->orderBy('name')
            ->paginate(10);

        return response()->json([
            'data' => $state->items(),
            'pagination' => [
                'more' => $state->hasMorePages()
            ]
        ]);
    }

    public function ajaxCitySearch(Request $request)
    {
        $query = City::query();

        if ($request->state_id) {
            $query->where('state_id', $request->state_id);
        }

        if ($request->q) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $cities = $query->limit(10)->get(['id', 'name']);
        return response()->json(['data' => $cities]);
    }

}
