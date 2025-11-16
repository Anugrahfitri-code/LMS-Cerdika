<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query()->where('is_active', true);

        $popularCourses = $query->withCount('students')
                                ->orderBy('students_count', 'desc')
                                ->take(5)
                                ->get();

        $categories = Category::all();

        return view('homepage', [
            'popularCourses' => $popularCourses,
            'categories' => $categories,
        ]);
    }
    public function catalog(Request $request)
    {
        $query = Course::query()->where('is_active', true);
        $categories = Category::all();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $courses = $query->with('category', 'teacher')
                        ->withCount('students') 
                        ->paginate(9); 

        $enrolledCourseIds = [];
        if (Auth::check() && Auth::user()->role === 'student') {
            $enrolledCourseIds = Auth::user()->enrolledCourses()->pluck('courses.id')->toArray();
        }

        return view('course-catalog', [
            'courses' => $courses,
            'categories' => $categories,
            'enrolledCourseIds' => $enrolledCourseIds,                
        ]);
    }
}
