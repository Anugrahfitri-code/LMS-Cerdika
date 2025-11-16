<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Progress;

class ProgressController extends Controller
{
    public function store(Request $request, Content $content)
    {
        $user = Auth::user();

        $isEnrolled = $user->enrolledCourses()->where('course_id', $content->course_id)->exists();
        if (!$isEnrolled) {
            return back()->with('error', 'Anda tidak terdaftar di kursus ini.');
        }

        Progress::firstOrCreate(
            [
                'user_id' => $user->id,
                'content_id' => $content->id,
            ]
        );

        return back()->with('success', 'Materi ditandai selesai!');
    }
}