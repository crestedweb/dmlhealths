<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', fn () => app(PublicPageController::class)->show('about'))->name('about');
Route::get('/mission', fn () => app(PublicPageController::class)->show('mission'))->name('mission');
Route::get('/our-approach', fn () => app(PublicPageController::class)->show('our-approach'))->name('approach');
Route::get('/resources', fn () => app(PublicPageController::class)->show('resources'))->name('resources');
Route::get('/faq', fn () => app(PublicPageController::class)->show('faq'))->name('faq');
Route::get('/support-us', fn () => app(PublicPageController::class)->show('support-us'))->name('support-us');
Route::get('/gallery', fn () => app(PublicPageController::class)->show('gallery'))->name('gallery');
Route::get('/team', fn () => app(PublicPageController::class)->show('team'))->name('team');
Route::get('/services', fn () => app(PublicPageController::class)->service('residential-care'))->name('services');
Route::get('/services/{service}', [PublicPageController::class, 'service'])->name('service');
Route::get('/cpr-training', fn () => view('pages.cpr-training', [
    'title' => 'CPR Training | DMI Healths',
    'description' => 'Request CPR, First Aid, and workplace training availability in Palmdale, Los Angeles, CA.',
]))->name('cpr-training');
Route::post('/cpr-training', [ContactController::class, 'storeTraining'])->middleware('throttle:5,1')->name('cpr-training.store');
Route::get('/eligibility/{condition}', [PublicPageController::class, 'eligibility'])->name('eligibility');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::get('/request-information', [ContactController::class, 'requestInfo'])->name('request-information');
Route::post('/request-information', [ContactController::class, 'storeInfo'])->middleware('throttle:5,1')->name('request-information.store');
Route::post('/newsletter', [ContactController::class, 'subscribe'])->middleware('throttle:3,1')->name('newsletter.subscribe');
Route::get('/admin/login', [AuthController::class, 'create'])->middleware('guest')->name('login');
Route::post('/admin/login', [AuthController::class, 'store'])->middleware(['guest', 'throttle:5,1'])->name('login.store');
Route::post('/admin/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin');
