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

    private function getSidebarData(Course $course)
    {
        $courseContents = $course->contents()->orderBy('order', 'asc')->get();
        $user = Auth::user();
        
        $completedContentIds = [];
        if($user && $user->role === 'student') {
            $completedContentIds = $user->progress()
                ->whereIn('content_id', $courseContents->pluck('id'))
                ->pluck('content_id')
                ->toArray();
        }

        return [$courseContents, $completedContentIds];
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

        if (Auth::user()->role === 'teacher' || Auth::user()->role === 'admin') {
            return view('threads.teacher_index', compact('course', 'threads'));
        }        
                  
        [$courseContents, $completedContentIds] = $this->getSidebarData($course);

        return view('threads.index', compact('course', 'threads', 'courseContents', 'completedContentIds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $this->checkAccess($course);

        [$courseContents, $completedContentIds] = $this->getSidebarData($course);

        return view('threads.create', compact('course', 'courseContents', 'completedContentIds'));
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
        
        [$courseContents, $completedContentIds] = $this->getSidebarData($course);

        return view('threads.show', compact('course', 'thread', 'posts', 'courseContents', 'completedContentIds'));    
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
    public function destroy(Course $course, Thread $thread)
    {
        $user = Auth::user();

        if ($user->id !== $thread->user_id && $user->role !== 'admin' && $user->role !== 'teacher') {
            abort(403, 'Anda tidak memiliki izin untuk menghapus diskusi ini.');
        }

        $thread->delete();

        return redirect()->route('courses.threads.index', $course)
                         ->with('success', 'Topik diskusi berhasil dihapus.');
    }
}