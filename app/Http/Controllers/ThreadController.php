<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ThreadController extends Controller
{
    private function checkAccess(Course $course)
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return true;
        }
        if ($user->id === $course->user_id) {
            return true;
        }
        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return true;
        }
        abort(403, 'Anda tidak memiliki akses ke forum ini.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $this->checkAccess($course); 

        $threads = $course->threads()
                          ->with('user')
                          ->withCount('posts') 
                          ->latest()
                          ->paginate(10);

        return view('threads.index', compact('course', 'threads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $this->checkAccess($course);
        return view('threads.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $this->checkAccess($course); 

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $thread = $course->threads()->create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('courses.threads.show', ['course' => $course, 'thread' => $thread])
                         ->with('success', 'Diskusi berhasil dimulai.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course, Thread $thread)
    {
        $this->checkAccess($course); 

        if ($thread->course_id !== $course->id) {
            abort(404);
        }

        $posts = $thread->posts()
                        ->with('user') 
                        ->latest()
                        ->paginate(10);

        return view('threads.show', compact('course', 'thread', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
