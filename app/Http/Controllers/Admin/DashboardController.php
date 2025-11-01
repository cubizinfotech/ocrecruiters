<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Location;
use App\Models\Recruiter;
use App\Models\State;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRecruiter = Recruiter::query()->count();

        $totalCategroy = Category::query()->count();

        $totalLocation = Location::query()->count();

        $totalState = State::query()->count();

        $totalCity = City::query()->count();

        return view('admin.dashboard',compact('totalRecruiter', 'totalCategroy', 'totalLocation', 'totalState', 'totalCity'));
    }
}
