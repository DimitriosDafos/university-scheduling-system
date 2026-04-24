<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\EventController as WebEventController;
use App\Http\Controllers\Auth\MicrosoftController;

Route::get('/', function () {
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

require __DIR__.'/auth.php';
