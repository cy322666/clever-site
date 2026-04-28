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
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\ArticleController;
use App\Http\Controllers\Site\CaseStudyController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\LandingController;
use App\Http\Controllers\Site\RobotsController;
use App\Http\Controllers\Site\ServiceController;
use App\Http\Controllers\Site\SitemapController;
use App\Http\Controllers\Site\SiteInquiryController;
use App\Http\Controllers\Site\WidgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('site.home');
Route::get('/robots.txt', RobotsController::class)->name('site.robots');
Route::get('/sitemap.xml', SitemapController::class)->name('site.sitemap');
Route::get('/demo-hero', fn () => response()->file(public_path('demo-hero.html')));
Route::get('/demo-hero-v2', fn () => response()->file(public_path('demo-hero-v2.html')));
Route::get('/demo-hero-v3', fn () => response()->file(public_path('demo-hero-v3.html')));
Route::get('/demo-hero-v4', fn () => response()->file(public_path('demo-hero-v4.html')));
Route::get('/demo-hero-v5', fn () => response()->file(public_path('demo-hero-v5.html')));
Route::get('/demo-hero-v6', fn () => response()->file(public_path('demo-hero-v6.html')));
Route::get('/demo-hero-v7', fn () => response()->file(public_path('demo-hero-v7.html')));
Route::get('/demo-hero-v8', fn () => response()->file(public_path('demo-hero-v8.html')));
Route::get('/demo-hero-v9', fn () => response()->file(public_path('demo-hero-v9.html')));
Route::get('/demo-hero-v10', fn () => response()->file(public_path('demo-hero-v10.html')));
Route::get('/demo-section2', fn () => response()->file(public_path('demo-section2.html')));
Route::get('/demo-section2-v2', fn () => response()->file(public_path('demo-section2-v2.html')));
Route::get('/demo-section2-v3', fn () => response()->file(public_path('demo-section2-v3.html')));
Route::get('/demo-section3', fn () => response()->file(public_path('demo-section3.html')));
Route::get('/demo-section3-v2', fn () => response()->file(public_path('demo-section3-v2.html')));
Route::get('/demo-section4', fn () => response()->file(public_path('demo-section4.html')));
Route::get('/demo-section4-v2', fn () => response()->file(public_path('demo-section4-v2.html')));
Route::get('/demo-section4-v3', fn () => response()->file(public_path('demo-section4-v3.html')));
Route::get('/demo-images-b2b', fn () => response()->file(public_path('demo-images-b2b.html')));
Route::get('/demo-images-b2b-v2', fn () => response()->file(public_path('demo-images-b2b-v2.html')));
Route::get('/demo-section5', fn () => response()->file(public_path('demo-section5.html')));
Route::get('/demo-trust', fn () => response()->file(public_path('demo-trust.html')));
Route::get('/demo-section6', fn () => response()->file(public_path('demo-section6.html')));
Route::get('/demo-section6-v2', fn () => response()->file(public_path('demo-section6-v2.html')));
Route::get('/demo-section7', fn () => response()->file(public_path('demo-section7.html')));
Route::get('/demo-section7-improve', fn () => response()->file(public_path('demo-section7-improve.html')));
Route::get('/demo-play-btn', fn () => response()->file(public_path('demo-play-btn.html')));
Route::get('/demo-cases', fn () => response()->file(public_path('demo-cases.html')));
Route::get('/demo-useful', fn () => response()->file(public_path('demo-useful.html')));
Route::get('/demo-faq', fn () => response()->file(public_path('demo-faq.html')));
Route::get('/demo-cta', fn () => response()->file(public_path('demo-cta.html')));
Route::get('/demo-footer', fn () => response()->file(public_path('demo-footer.html')));
Route::get('/demo-header', fn () => response()->file(public_path('demo-header.html')));
Route::get('/demo-animations', fn () => response()->file(public_path('demo-animations.html')));
Route::get('/demo-animations-v2', fn () => response()->file(public_path('demo-animations-v2.html')));
Route::get('/demo-anim-hero', fn () => response()->file(public_path('demo-anim-hero.html')));
Route::get('/services', [ServiceController::class, 'index'])->name('site.services.index');
Route::get('/services/vnedrenie-crm', [ServiceController::class, 'implementation'])->name('site.services.amocrm-implementation');
Route::get('/services/razrabotka-crm', [ServiceController::class, 'development'])->name('site.services.amocrm-development');
Route::get('/services/reanimaciya-amocrm', [ServiceController::class, 'resuscitation'])->name('site.services.amocrm-resuscitation');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('site.services.show');
Route::get('/case-studies', [CaseStudyController::class, 'index'])->name('site.case-studies.index');
Route::get('/case-studies/{slug}', [CaseStudyController::class, 'show'])->name('site.case-studies.show');
Route::get('/articles', [ArticleController::class, 'index'])->name('site.articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('site.articles.show');
Route::get('/solutions/{slug}', [LandingController::class, 'show'])->name('site.landings.show');
Route::get('/widgets', [WidgetController::class, 'index'])->name('site.widgets.index');
Route::get('/widgets/{slug}', [WidgetController::class, 'show'])->name('site.widgets.show');
Route::get('/about', AboutController::class)->name('site.about');
Route::view('/project-estimate', 'site.calculator', [
    'title' => 'Предварительная оценка CRM-проекта | CleverCRM',
    'metaDescription' => 'Калькулятор предварительной оценки CRM-проекта: бюджетный диапазон, сроки и состав работ от CleverCRM.',
])->name('site.calculator');
Route::get('/contacts', ContactController::class)->name('site.contacts');
Route::view('/policy', 'site.policy', [
    'title' => 'Политика обработки персональных данных | CleverCRM',
    'metaDescription' => 'Политика обработки персональных данных CleverCRM.',
])->name('site.policy');
Route::post('/inquiries', [SiteInquiryController::class, 'store'])->name('site.inquiries.store');

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
