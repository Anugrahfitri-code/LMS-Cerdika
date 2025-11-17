<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Course;
use App\Policies\CoursePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator; 
use App\Models\Content;
use App\Policies\ContentPolicy;
use App\Models\Post;
use App\Policies\PostPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Content::class, ContentPolicy::class);
        Gate::policy(Post::class, PostPolicy::class); // <-- TAMBAHKAN INI
    }
}