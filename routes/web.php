<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('/note', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    Route::get('/note/show/{id}', [NoteController::class, 'show'])->name('note.show');
    Route::get('/note/edit/{id}', [NoteController::class, 'edit'])->name('note.edit');
    Route::post('/note', [NoteController::class, 'store'])->name('note.store');
    Route::patch('/note/{id}', [NoteController::class, 'update'])->name('note.update');
    Route::delete('/note/{id}', [NoteController::class, 'destroy'])->name('note.destroy');
});

require __DIR__ . '/auth.php';
