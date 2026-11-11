<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\GeocodeController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMembershipController;
use App\Http\Controllers\NotificationController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/games/search', [GameController::class, 'search'])->name('games.search');
Route::resource('games', GameController::class)->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{game}', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmarks/{game}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});

Route::post('/games/{game}/apply', [ApplicantController::class, 'store'])->name('applicant.store')->middleware('auth');
Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('applicant.destroy')->middleware('auth');

Route::get('/geocode', [GeocodeController::class, 'geocode']);

// Google Auth Routes 
Route::get('/auth/google/redirect', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Teams
Route::middleware('auth')->group(function () {

    // Teams
    Route::resource('teams', TeamController::class)
        ->only(['index', 'create', 'store', 'show']);

    // Join requests
    Route::post(
        '/teams/{team}/join',
        [TeamMembershipController::class, 'store']
    )->name('teams.join');

    // Approve requests
    Route::post(
        '/teams/{team}/members/{user}/approve',
        [TeamMembershipController::class, 'approve']
    )->name('teams.members.approve');
});

Route::resource('teams', TeamController::class)
    ->only(['index', 'create', 'store', 'show']);

Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])
    ->name('teams.edit');

Route::put('/teams/{team}', [TeamController::class, 'update'])
    ->name('teams.update');


// Teams
Route::middleware('auth')->group(function () {

    Route::resource('teams', TeamController::class)
        ->only(['index', 'create', 'store', 'show', 'edit', 'update']);

    // Submit join request
    Route::post('/teams/{team}/join', [TeamMembershipController::class, 'store'])
        ->name('teams.join');

    // Approve join request
    Route::post('/teams/{team}/requests/{user}/approve', [TeamMembershipController::class, 'approve'])
        ->name('teams.requests.approve');

    // Reject join request
    Route::delete('/teams/{team}/requests/{user}', [TeamMembershipController::class, 'reject'])
        ->name('teams.requests.reject');

    // Remove team member
    Route::delete('/teams/{team}/members/{user}', [TeamMembershipController::class, 'remove'])
        ->name('teams.members.remove');


    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.markAllRead');

    Route::post('/notifications/{notification}/read', [NotificationController::class, 'read'])
        ->name('notifications.read');

    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');

    Route::delete('/notifications', [NotificationController::class, 'destroyAll'])
        ->name('notifications.destroyAll');
});
