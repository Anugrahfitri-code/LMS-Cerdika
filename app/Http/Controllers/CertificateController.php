<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function generate(Course $course)
    {
        $user = Auth::user();

        $isEnrolled = $user->enrolledCourses()->where('course_id', $course->id)->exists();
        if (!$isEnrolled) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak terdaftar di kursus ini.');
        }

        $totalContents = $course->contents()->count();
        $completedContents = $user->progress()
                                  ->whereIn('content_id', $course->contents->pluck('id'))
                                  ->count();

        if ($totalContents == 0 || $completedContents < $totalContents) {
            return redirect()->route('dashboard')->with('error', 'Anda harus menyelesaikan 100% materi untuk mengunduh sertifikat.');
        }

        $lastProgress = $user->progress()
            ->whereIn('content_id', $course->contents->pluck('id'))
            ->latest('created_at') 
            ->first();

        $dateCompleted = $lastProgress ? $lastProgress->created_at : now();
        // --------------------------------

        $data = [
            'studentName' => $user->name,
            'courseName' => $course->title,
            'teacherName' => $course->teacher->name,
            'completionDate' => $dateCompleted->format('d F Y'), 
        ];

        $pdf = Pdf::loadView('certificate.template', $data);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('sertifikat-' . Str::slug($course->title) . '.pdf');
    }
}