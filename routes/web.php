<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoodEntryController;
use App\Http\Controllers\SupportBoardController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/mood', [MoodEntryController::class, 'index'])->name('mood.index');
Route::post('/mood', [MoodEntryController::class, 'store'])->name('mood.store');
Route::delete('/mood/{moodEntry}', [MoodEntryController::class, 'destroy'])->name('mood.destroy');

Route::get('/journal', function () {
    return view('journal');
});

Route::get('/goals', function () {
    return view('goals');
});

Route::get('/resources', function () {
    return view('resources');
});

Route::get('/support', [SupportBoardController::class, 'index'])->name('support.index');

Route::post('/support/posts', [SupportBoardController::class, 'storePost'])->name('support.posts.store');

Route::post('/support/posts/{supportPost}/replies', [SupportBoardController::class, 'storeReply'])->name('support.replies.store');

Route::delete('/support/posts/{supportPost}', [SupportBoardController::class, 'destroyPost'])->name('support.posts.destroy');
