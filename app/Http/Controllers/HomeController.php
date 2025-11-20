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
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $courses = $query->with('category', 'teacher')
                        ->withCount('students') 
                        ->latest()
                        ->paginate(9)
                        ->withQueryString(); 

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
    
    public function show(Course $course)
    {
        if (!$course->is_active) {
            abort(404);
        }

        $course->load('teacher', 'category', 'contents'); 
        $course->loadCount('students'); 

        return view('public-course-show', compact('course'));
    }
    public function filter(Request $request)
    {
        $slug = $request->category;
        $query = Course::query()->where('is_active', true);

        if ($slug && $slug !== 'all') {
            $query->whereHas('category', function($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }

        $courses = $query->withCount('students')->take(4)->get();

        return view('partials.course-cards', compact('courses'))->render();
    }
    public function stories()
    {
        $stories = [
            [
                'name' => 'Andi Pratama',
                'role' => 'Full Stack Developer',
                'company' => 'GoTo Group',
                'quote' => 'Berkat LMS-Cerdika, saya berhasil beralih karier dari Admin menjadi Developer dalam waktu 6 bulan. Materinya sangat relevan dengan industri.',
                'avatar_color' => 'bg-blue-100 text-blue-600',
                'course' => 'Mastering Laravel 11'
            ],
            [
                'name' => 'Siti Aminah',
                'role' => 'Data Analyst',
                'company' => 'Bank Mandiri',
                'quote' => 'Kursus Data Science di sini sangat detail. Saya belajar Python dari nol sampai bisa membuat model prediksi harga saham.',
                'avatar_color' => 'bg-purple-100 text-purple-600',
                'course' => 'Data Science Bootcamp'
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Digital Marketer',
                'company' => 'Shopee',
                'quote' => 'Saya belajar cara optimasi SEO dan Ads yang efektif. Omset toko online saya naik 300% setelah menerapkan ilmu dari sini.',
                'avatar_color' => 'bg-orange-100 text-orange-600',
                'course' => 'Digital Marketing Masterclass'
            ],
            [
                'name' => 'Dian Sastro',
                'role' => 'UI/UX Designer',
                'company' => 'Freelance',
                'quote' => 'Portofolio yang saya bangun selama kursus membantu saya mendapatkan klien pertama dari luar negeri. Sangat direkomendasikan!',
                'avatar_color' => 'bg-pink-100 text-pink-600',
                'course' => 'UI/UX Design Fundamental'
            ],
            [
                'name' => 'Eko Kurniawan',
                'role' => 'Backend Engineer',
                'company' => 'Traveloka',
                'quote' => 'Penjelasan tentang Microservices dan API sangat membuka wawasan. Karir saya melesat setelah mengambil sertifikasi di sini.',
                'avatar_color' => 'bg-green-100 text-green-600',
                'course' => 'Advanced Backend Engineering'
            ],
            [
                'name' => 'Rina Wati',
                'role' => 'Content Creator',
                'company' => 'YouTube',
                'quote' => 'Tidak hanya teknis, saya juga belajar cara personal branding. Sekarang channel saya sudah tembus 100k subscribers.',
                'avatar_color' => 'bg-red-100 text-red-600',
                'course' => 'Content Strategy'
            ],
        ];

        return view('success-stories', compact('stories'));
    }
}
