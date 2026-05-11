<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/tag/{tag:slug}', [BlogController::class, 'tag'])->name('blog.tag');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/page/{page:slug}', [PageController::class, 'show'])->name('pages.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard')->middleware('permission:dashboard.view');

        Route::resource('posts', PostController::class)->middleware('permission:posts.view');
        Route::resource('categories', CategoryController::class)->except(['show'])->middleware('permission:categories.view');
        Route::resource('tags', TagController::class)->except(['show'])->middleware('permission:tags.view');
        Route::resource('comments', CommentController::class)->only(['index', 'edit', 'update', 'destroy'])->middleware('permission:comments.view');
        Route::get('media', [MediaController::class, 'index'])->name('media.index')->middleware('permission:media.view');
        Route::resource('pages', AdminPageController::class)->middleware('permission:pages.view');
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update'])->middleware('permission:users.view');
        Route::resource('roles', RoleController::class)->only(['index', 'edit', 'update'])->middleware('permission:roles.view');
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit')->middleware('permission:settings.view');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update')->middleware('permission:settings.update');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
