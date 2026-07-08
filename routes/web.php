<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/mood', function () {
    return view('mood');
});

Route::get('/journal', function () {
    return view('journal');
});

Route::get('/goals', function () {
    return view('goals');
});

Route::get('/resources', function () {
    return view('resources');
});

Route::get('/support', function () {
    return view('support');
});