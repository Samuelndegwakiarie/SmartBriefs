<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
<<<<<<< HEAD
    return redirect()->route('briefs.index');
=======
    return view('dashboard');
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
<<<<<<< HEAD

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    });

    Route::post('/briefs/{brief}/ai', [\App\Http\Controllers\BriefController::class, 'generateAi'])->name('briefs.ai');
    Route::resource('briefs', \App\Http\Controllers\BriefController::class);
=======
>>>>>>> d6a9fd3dfce3c7e14c12febe8a5c360c6f8e7009
});

require __DIR__.'/auth.php';
