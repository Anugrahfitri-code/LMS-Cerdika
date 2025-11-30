<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Content;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [];

        if ($user->role === 'student') {
            $enrolledCourses = $user->enrolledCourses()
                ->with('teacher', 'category')
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
                ->with('category')
                ->withCount(['students', 'contents'])
                ->latest()
                ->get();

        } else {
            $data['stats'] = [
                'total_users' => User::count(),
                'total_students' => User::where('role', 'student')->count(),
                'total_teachers' => User::where('role', 'teacher')->count(),
                'total_courses' => Course::count(),
                'total_categories' => Category::count(),
                'total_contents' => Content::count(),
            ];

            $data['recentUsers'] = User::where('id', '!=', auth()->id())
                                        ->latest()
                                        ->take(5)
                                        ->get();
        }

        return view('dashboard', $data);
    }
}