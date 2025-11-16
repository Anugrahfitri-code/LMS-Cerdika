<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $enrolledCourses = [];

        if ($user->role === 'student') {
            $enrolledCourses = $user->enrolledCourses()
                                   ->with('teacher') 
                                   ->get();
        }

        return view('dashboard', [
            'enrolledCourses' => $enrolledCourses
        ]);
    }
}