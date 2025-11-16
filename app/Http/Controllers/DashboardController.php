<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->role === 'student') {
            $enrolledCourses = $user->enrolledCourses()
                ->with('teacher')
                ->withCount('contents')
                ->get();
            
            foreach ($enrolledCourses as $course) {
                $completedContents = $user->progress()
                                          ->whereIn('content_id', $course->contents->pluck('id'))
                                          ->count();
                
                if ($course->contents_count > 0) {
                    $course->progress_percentage = ($completedContents / $course->contents_count) * 100;
                } else {
                    $course->progress_percentage = 0;
                }

                $course->firstContent = $course->contents()->orderBy('order', 'asc')->first();
            }
            
            $data['enrolledCourses'] = $enrolledCourses;

        } elseif ($user->role === 'teacher') {
            $data['taughtCourses'] = $user->courses()
                                         ->withCount('students') 
                                         ->latest()
                                         ->get();
        }
                
        return view('dashboard', $data);
    }
}