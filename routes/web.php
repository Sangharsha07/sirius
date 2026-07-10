<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MoodEntryController;
use App\Http\Controllers\SupportBoardController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about-us', function () {
    return view('about-us');
})->name('about.us');

Route::get('/terms-and-conditions', function () {
    return view('terms-and-conditions');
})->name('terms');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy');

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Mood Tracker Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/mood', [MoodEntryController::class, 'index'])
        ->name('mood.index');
        
    Route::post('/mood/analyze',[MoodEntryController::class, 'analyze'])
        ->name('mood.analyze');

    Route::post('/mood', [MoodEntryController::class, 'store'])
        ->name('mood.store');

    Route::delete('/mood/{moodEntry}', [MoodEntryController::class, 'destroy'])
        ->name('mood.destroy');

    /*
    |--------------------------------------------------------------------------
    | Other Sirius Pages
    |--------------------------------------------------------------------------
    */

    Route::get('/journal', [JournalController::class, 'index'])
        ->name('journal.index');

    Route::post('/journal', [JournalController::class, 'store'])
        ->name('journal.store');

    Route::get('/goals', [GoalController::class, 'index'])
        ->name('goals.index');

    Route::post('/goals', [GoalController::class, 'store'])
        ->name('goals.store');

    Route::patch('/goals/{goal}/toggle', [GoalController::class, 'toggleStatus'])
        ->name('goals.toggle');

    Route::get('/resources', function () {
        return view('resources');
    })->name('resources');

    /*
    |--------------------------------------------------------------------------
    | Support Board Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/support', [SupportBoardController::class, 'index'])
        ->name('support.index');

    Route::post('/support/posts', [SupportBoardController::class, 'storePost'])
        ->name('support.posts.store');

    Route::post('/support/posts/{supportPost}/replies', [SupportBoardController::class, 'storeReply'])
        ->name('support.replies.store');

    Route::delete('/support/posts/{supportPost}', [SupportBoardController::class, 'destroyPost'])
        ->name('support.posts.destroy');

    Route::delete('/support/replies/{supportReply}', [SupportBoardController::class, 'destroyReply'])
        ->name('support.replies.destroy');

    /*
    |--------------------------------------------------------------------------
    | Support Voting Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/support/posts/{supportPost}/upvote', [SupportBoardController::class, 'upvotePost'])
        ->name('support.posts.upvote');

    Route::get('/support/posts/{supportPost}/downvote', [SupportBoardController::class, 'downvotePost'])
        ->name('support.posts.downvote');

    Route::get('/support/replies/{supportReply}/upvote', [SupportBoardController::class, 'upvoteReply'])
        ->name('support.replies.upvote');

    Route::get('/support/replies/{supportReply}/downvote', [SupportBoardController::class, 'downvoteReply'])
        ->name('support.replies.downvote');

    /*
    |--------------------------------------------------------------------------
    | Admin Review Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/support/review', [SupportBoardController::class, 'reviewQueue'])
        ->name('support.review');

    Route::patch('/support/review/posts/{supportPost}/approve', [SupportBoardController::class, 'approvePost'])
        ->name('support.review.posts.approve');

    Route::delete('/support/review/posts/{supportPost}', [SupportBoardController::class, 'rejectPost'])
        ->name('support.review.posts.reject');

    Route::patch('/support/review/replies/{supportReply}/approve', [SupportBoardController::class, 'approveReply'])
        ->name('support.review.replies.approve');

    Route::delete('/support/review/replies/{supportReply}', [SupportBoardController::class, 'rejectReply'])
        ->name('support.review.replies.reject');

    /*
    |--------------------------------------------------------------------------
    | Breeze Profile Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});
/*
|--------------------------------------------------------------------------
| Global Route Aliases for Frontend Navigation Links
|--------------------------------------------------------------------------
*/
// Point the plain 'journal' name to the same controller method
Route::get('/journal-bridge', [JournalController::class, 'index'])->middleware('auth')->name('journal');

// Point the plain 'goals' name to the same controller method
Route::get('/goals-bridge', [GoalController::class, 'index'])->middleware('auth')->name('goals');

require __DIR__.'/auth.php';