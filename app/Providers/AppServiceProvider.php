<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });

        View::composer('*', function ($view): void {
            $settings = collect();
            $categories = collect();
            $tags = collect();

            if (Schema::hasTable('settings')) {
                $settings = Setting::where('group', 'site')->get()->mapWithKeys(
                    fn (Setting $setting) => [$setting->key => data_get($setting->value, $setting->key)]
                );

                $fallbackPostImagePath = $settings->get('fallback_post_image_path');
                $settings->put(
                    'fallback_post_image_url',
                    filled($fallbackPostImagePath)
                        ? Storage::disk('public')->url($fallbackPostImagePath)
                        : asset('vendor/daiva/codye2.png')
                );
            }

            if (Schema::hasTable('categories')) {
                $categories = Category::orderBy('name')->take(6)->get();
            }

            if (Schema::hasTable('tags')) {
                $tags = Tag::orderBy('name')->take(8)->get();
            }

            $view->with('siteSettings', $settings);
            $view->with('blogSidebarCategories', $categories);
            $view->with('blogSidebarTags', $tags);
        });
    }
}
