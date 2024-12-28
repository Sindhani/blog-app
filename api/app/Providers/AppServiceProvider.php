<?php

namespace App\Providers;


use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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


        Route::bind('blog', function ($value) {
            $cacheKey = "blog_{$value}";
            return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($value) {
                return Blog::query()->where('slug', $value)->firstOrFail();
            });
        });
    }
}
