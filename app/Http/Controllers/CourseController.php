<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Support\Facades\Gate; 

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Course::class);
        $query = Course::query();

        if (auth()->user()->role === 'teacher') {
            $query->where('user_id', auth()->id());
        }

        $courses = $query->with('category', 'teacher')->paginate(10);

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Course::class);
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();
        return view('courses.create', compact('categories', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();

        if(auth()->user()->role === 'teacher') {
            $data['user_id'] = auth()->id();
        }

        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Kursus berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $this->authorize('view', $course);

        $course->load('category', 'teacher');
        
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        $categories = Category::all();
        $teachers = User::where('role', 'teacher')->get();
        return view('courses.edit', compact('course', 'categories', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();

        if(auth()->user()->role === 'teacher') {
            $data['user_id'] = auth()->id();
        }

        $course->update($data);
        return redirect()->route('courses.index')->with('success', 'Kursus berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Kursus berhasil dihapus.');
    }

    public function studentProgress(Course $course)
    {
        $this->authorize('update', $course);

        $contentIds = $course->contents()->pluck('id');
        $totalContents = $contentIds->count();

        $students = $course->students()
            ->withCount(['progress as completed_count' => function ($query) use ($contentIds) {
                $query->whereIn('content_id', $contentIds);
            }])
            ->get();

        foreach ($students as $student) {
            if ($totalContents > 0) {
                $student->progress_percentage = round(($student->completed_count / $totalContents) * 100);
            } else {
                $student->progress_percentage = 0;
            }
        }

        return view('courses.student-progress', compact('course', 'students', 'totalContents'));
    }
}
