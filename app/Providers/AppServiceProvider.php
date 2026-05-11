<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Tag;
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
        View::composer('*', function ($view): void {
            $settings = collect();
            $categories = collect();
            $tags = collect();

            if (Schema::hasTable('settings')) {
                $settings = Setting::where('group', 'site')->get()->mapWithKeys(
                    fn (Setting $setting) => [$setting->key => data_get($setting->value, $setting->key)]
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
