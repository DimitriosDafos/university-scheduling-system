<?php

use App\Http\Controllers\Auth\MicrosoftController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\EventController as WebEventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('events', WebEventController::class)->except(['show']);
    Route::get('monitor', [WebEventController::class, 'monitor'])->name('monitor');
});

Route::get('/auth/microsoft/redirect', [MicrosoftController::class, 'redirect'])
    ->name('microsoft.login');

Route::get('/auth/microsoft/callback', [MicrosoftController::class, 'callback']);

Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('language.switch');

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\RoomController;

// ... other routes ...

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Admin dashboard
    Route::resource('categories', CategoryController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('lecturers', LecturerController::class);
});

require __DIR__.'/auth.php';
