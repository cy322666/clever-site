<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CaseStudyController as AdminCaseStudyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\JsPluginController as AdminJsPluginController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\WidgetController as AdminWidgetController;
use App\Http\Controllers\Site\ArticleController;
use App\Http\Controllers\Site\CaseStudyController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\LandingController;
use App\Http\Controllers\Site\WidgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('site.home');
Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('site.case-studies.index');
Route::get('/case-studies/{slug}', [CaseStudyController::class, 'show'])->name('site.case-studies.show');
Route::get('/articles', [ArticleController::class, 'index'])->name('site.articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('site.articles.show');
Route::get('/widgets', [WidgetController::class, 'index'])->name('site.widgets.index');
Route::get('/widgets/{slug}', [WidgetController::class, 'show'])->name('site.widgets.show');
Route::get('/contacts', ContactController::class)->name('site.contacts');
Route::get('/solutions/{slug}', [LandingController::class, 'show'])->name('site.landings.show');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AuthController::class, 'create'])->name('login');
        Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::resource('services', AdminServiceController::class)->except(['show']);
        Route::resource('case-studies', AdminCaseStudyController::class)->except(['show']);
        Route::resource('articles', AdminArticleController::class)->except(['show']);
        Route::resource('widgets', AdminWidgetController::class)->except(['show']);
        Route::resource('js-plugins', AdminJsPluginController::class)->except(['show']);
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
        Route::resource('faqs', AdminFaqController::class)->except(['show']);

        Route::get('/site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
        Route::put('/site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
    });
});
