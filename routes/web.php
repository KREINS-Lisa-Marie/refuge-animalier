<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('public.homepage');
})->name('public.homepage');


Route::get('/contact', function () {
    return view('public.contact');
})->name('public.contact');


Route::get('/animal', function () {
    return view('public.animal');
})->name('public.animal');

Route::get('/animals', function () {
    return view('public.animals');
})->name('public.animals');


Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('auth.forgot-password');
