<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

Route::get('/{locale}', [HomepageController::class, 'index'])->name('public.homepage')->middleware('guest');

Route::get('/', function () {
    return redirect()->route('auth.login', ['locale' => app()->getLocale()]);
})->middleware('guest');

Route::get('/{locale}/contact',  [ContactController::class, 'index'])->name('public.contact')->middleware('guest');

Route::post('/{locale}/contact',  [ContactController::class, 'store'])->name('public.contact.store')->middleware('guest');

Route::get('/{locale}/legals', function () {
    return view('public.legals');
})->name('public.legals')->middleware('guest');

Route::get('/{locale}/animals',   [AnimalController::class, 'index']
)->name('public.animals')->middleware('guest');

Route::get('/{locale}/animal/{animal}', [AnimalController::class, 'show'])->name('public.animal')->middleware('guest');

Route::post('/{locale}/animal/{animal}', [AnimalController::class, 'store'])->name('public.animal.store')->middleware('guest');

Route::get('/{locale}/login', function () {
    return view('auth.login');
})->name('auth.login')->middleware('guest');

Route::get('/{locale}/forgot-password', function () {
    return view('auth.forgot-password');
})->name('auth.forgot-password')->middleware('guest');

Route::get('/{locale}/reset-password', function () {
    return view('auth.reset-password');
})->name('auth.reset-password')->middleware('guest');



Route::livewire('/{locale}/dashboard', 'pages::dashboard.index')->name('pages::dashboard.index')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/animals', 'pages::animals.index')->name('pages::animals.index')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/animals/create', 'pages::animals.create')->name('pages::animals.create')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/animals/{animal}/show', 'pages::animals.show')->name('pages::animals.show')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/animals/{animal}/edit', 'pages::animals.edit')->name('pages::animals.edit')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/volunteers', 'pages::volunteers.index')->name('pages::volunteers.index')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/volunteers/{volunteer}/show', 'pages::volunteers.show')->name('pages::volunteers.show')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/volunteers/create', 'pages::volunteers.create')->name('pages::volunteers.create')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/volunteers/{volunteer}/edit', 'pages::volunteers.edit')->name('pages::volunteers.edit')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/adoption-requests', 'pages::adoption-requests.index')->name('pages::adoption-requests.index')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/adoption-requests/create', 'pages::adoption-requests.create')->name('pages::adoption-requests.create')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/adoption-requests/{adoption_request}/edit', 'pages::adoption-requests.edit')->name('pages::adoption-requests.edit')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/messages', 'pages::messages.index')->name('pages::messages.index')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/profile', 'pages::profile.index')->name('pages::profile.index')->middleware([
    'auth',
]);

Route::livewire('/{locale}/admin/profile/{profile}/edit', 'pages::profile.edit')->name('pages::profile.edit')->middleware([
    'auth',
]);
