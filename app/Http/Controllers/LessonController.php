<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function show(Course $course, Content $content)
    {
        $user = Auth::user();

        $isEnrolled = $user->enrolledCourses()->where('course_id', $course->id)->exists();
        if (!$isEnrolled) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak terdaftar di kursus ini.');
        }

        if ($content->course_id !== $course->id) {
            abort(404); 
        }

        $courseContents = $course->contents()->orderBy('order', 'asc')->get();

        $completedContentIds = $user->progress()->whereIn('content_id', $courseContents->pluck('id'))->pluck('id')->toArray();

        return view('lessons.show', [
            'course' => $course,
            'content' => $content,
            'courseContents' => $courseContents,
            'completedContentIds' => $completedContentIds,
        ]);
    }
}