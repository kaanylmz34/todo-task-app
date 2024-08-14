<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Task;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::middleware('auth')->group(function () {

    # Yönlendirme Sayfası
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'verified'])->group(function () {

    # Anasayfa
    Route::get('/dashboard', function () {
        // All Tasks
        $tasks = Task::all();

        return view('dashboard', compact('tasks'));
    })->name('dashboard');

    Route::prefix('/users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('user.list')->middleware('can:user.list');
        Route::get('/create', [UserController::class, 'create'])->name('user.create')->middleware('can:user.create');
        Route::post('/', [UserController::class, 'store'])->name('user.store')->middleware('can:user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show')->middleware('can:user.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('can:user.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('user.update')->middleware('can:user.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('can:user.destroy');
    });

});

require __DIR__.'/auth.php';
