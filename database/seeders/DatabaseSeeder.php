<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Course;
use App\Models\Content;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',     
            'password' => Hash::make('admin123'), 
            'role' => 'admin',
        ]);
        
        $this->command->info('>>> ADMIN CREATED: admin@gmail.com | admin123 <<<');

        $teachers = User::factory(15)->create(['role' => 'teacher']);
        $demoTeacher = $teachers->first(); 
        
        $this->command->info('15 Teachers created.');

        $students = User::factory(50)->create(['role' => 'student']);
        $demoStudent = User::factory()->create([
            'name' => 'Siswa Teladan',
            'email' => 'siswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
        
        $this->command->info('51 Students created.');

        $categories = collect([
            'Web Development', 'Data Science', 'Digital Marketing', 
            'Graphic Design', 'Mobile Development'
        ])->map(function ($name) {
            return Category::create([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name)
            ]);
        });
        
        $webCategory = $categories->firstWhere('name', 'Web Development');

        $demoCourse = Course::create([
            'user_id' => $demoTeacher->id,
            'category_id' => $webCategory->id,
            'title' => 'Mastering Laravel 11: Dari Nol sampai Mahir',
            'description' => 'Kursus lengkap mempelajari framework PHP terpopuler. Mulai dari instalasi, routing, controller, hingga deployment.',
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'is_active' => true,
        ]);

        $materiDemo = [
            ['judul' => 'Pengenalan & Instalasi', 'isi' => '<h3>Apa itu Laravel?</h3><p>Laravel adalah framework PHP yang ekspresif dan elegan.</p><h3>Cara Install</h3><p>Gunakan perintah: <code>composer create-project laravel/laravel example-app</code></p>'],
            ['judul' => 'Routing & Controller', 'isi' => '<h3>Routing Dasar</h3><p>Route didefinisikan di file <code>routes/web.php</code>.</p><h3>Membuat Controller</h3><p>Jalankan: <code>php artisan make:controller</code></p>'],
            ['judul' => 'Blade Templating', 'isi' => '<h3>Layouts</h3><p>Blade memudahkan kita membuat layout yang konsisten menggunakan inheritance template.</p>'],
            ['judul' => 'Database & Migrations', 'isi' => '<h3>Migration</h3><p>Adalah version control untuk database Anda.</p>'],
            ['judul' => 'Authentication (Breeze)', 'isi' => '<h3>Login Cepat</h3><p>Laravel Breeze menyediakan fitur login, register, dan reset password siap pakai.</p>'],
        ];

        foreach ($materiDemo as $index => $materi) {
            Content::create([
                'course_id' => $demoCourse->id,
                'title' => $materi['judul'],
                'body' => $materi['isi'],
                'order' => $index + 1,
            ]);
        }
        
        $demoStudent->enrolledCourses()->attach($demoCourse->id);

        for ($i = 0; $i < 29; $i++) {
            $course = Course::factory()->create([
                'user_id' => $teachers->random()->id,
                'category_id' => $categories->random()->id,
                'title' => 'Belajar ' . fake()->jobTitle(),
            ]);

            $contentCount = rand(3, 6);
            for ($j = 1; $j <= $contentCount; $j++) {
                Content::factory()->create([
                    'course_id' => $course->id,
                    'title' => 'Modul ' . $j . ': ' . fake()->words(3, true),
                    'order' => $j,
                ]);
            }
        }

        $allCourses = Course::all();
        foreach ($students as $student) {
            $coursesToEnroll = $allCourses->random(rand(0, 3));
            foreach ($coursesToEnroll as $c) {
                $student->enrolledCourses()->attach($c->id);
            }
        }
        
        $this->command->info('Seeding complete!');
    }
}
