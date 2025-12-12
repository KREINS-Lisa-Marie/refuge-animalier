<?php

use Illuminate\Support\Facades\Route;

Route::get('/{locale}', function () {
    return view('public.homepage');
})->name('public.homepage');


Route::get('/{locale}/contact', function () {
    return view('public.contact');
})->name('public.contact');

Route::get('/{locale}/animals', function () {
    return view('public.animals');
})->name('public.animals');

Route::get('/{locale}/animal', function () {
    return view('public.animal');
})->name('public.animal');

Route::get('/{locale}/login', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/{locale}/forgot-password', function () {
    return view('auth.forgot-password');
})->name('auth.forgot-password');

Route::get('/{locale}/reset-password', function () {
    return view('auth.reset-password');
})->name('auth.reset-password');



Route::livewire('/{locale}/dashboard', 'pages::dashboard.index')->name('pages::dashboard.index');

Route::livewire('/{locale}/admin/animals', 'pages::animals.index')->name('pages::animals.index');

Route::livewire('/{locale}/admin/volunteers', 'pages::volunteers.index')->name('pages::volunteers.index');

Route::livewire('/{locale}/admin/adoption-requests', 'pages::adoption-requests.index')->name('pages::adoption-requests.index');

Route::livewire('/{locale}/admin/messages', 'pages::messages.index')->name('pages::messages.index');

Route::livewire('/{locale}/admin/profile', 'pages::profile.index')->name('pages::profile.index');
