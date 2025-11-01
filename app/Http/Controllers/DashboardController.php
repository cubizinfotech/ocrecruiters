<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        
        $totalRecruiter = Recruiter::query()->count();

        //$ratingTotal = Recruiter::where('user_id',auth()->id())->first();
        
        return view('dashboard',compact('totalRecruiter'));
    }
}
