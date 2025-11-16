<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Course; 
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $this->authorize('viewAny', [Content::class, $course]);
        $contents = $course->contents()->orderBy('order', 'asc')->get();
        return view('contents.index', compact('course', 'contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $this->authorize('create', [Content::class, $course]);
        return view('contents.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContentRequest $request, Course $course)
    {
        $data = $request->validated();
        $course->contents()->create($data); 

        return redirect()->route('courses.contents.index', $course)->with('success', 'Materi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        $this->authorize('update', $content);

        $course = $content->course; 
        return view('contents.edit', compact('course', 'content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContentRequest $request, Content $content)
    {
        $data = $request->validated();
        $content->update($data);

        return redirect()->route('courses.contents.index', $content->course)->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        $this->authorize('delete', $content);

        $course = $content->course; 
        $content->delete();

        return redirect()->route('courses.contents.index', $course)->with('success', 'Materi berhasil dihapus.');
    }
}
