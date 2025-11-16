<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class EnrollmentController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $user = $request->user();

        $isEnrolled = $user->enrolledCourses()
                           ->where('course_id', $course->id)
                           ->exists();

        if ($isEnrolled) {
            return back()->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        $user->enrolledCourses()->attach($course->id);

        return redirect()->route('course.catalog')->with('success', 'Berhasil mendaftar ke kursus ' . $course->title . '!');
    }
}
