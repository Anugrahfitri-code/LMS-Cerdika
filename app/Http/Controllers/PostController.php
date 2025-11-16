<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request, Thread $thread)
    {
        $user = Auth::user();
        $course = $thread->course;

        $isAllowed = $user->role === 'admin' ||
                     $user->id === $course->user_id ||
                     $user->enrolledCourses()->where('course_id', $course->id)->exists();

        if (!$isAllowed) {
            abort(403, 'Anda tidak memiliki akses untuk membalas.');
        }

        $request->validate([
            'body' => 'required|string',
        ]);

        $thread->posts()->create([
            'user_id' => $user->id,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); 

        $post->delete();
        return back()->with('success', 'Balasan berhasil dihapus.');
    }
}