<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TutorApplicationController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/tutor-application', [TutorApplicationController::class, 'create'])->name('tutor-application');
Route::post('/tutor-application', [TutorApplicationController::class, 'store']);

// Learning Portal (placeholder for now)
Route::get('/learning-portal', function () {
    return redirect('https://portal.quest4knowledge.co.za');
})->name('learning-portal');


// Pages
Route::get('/request-tutor', function () {
    return view('request-tutor');
})->name('request-tutor');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';