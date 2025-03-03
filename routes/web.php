<?php

use App\Enums\TaskStatus;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Jobs\SendTaskStatusEmail;
use App\Models\Task;
use App\Models\User;
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
});

require __DIR__ . '/auth.php';

Route::resource('tasks', TaskController::class)->middleware('auth');
Route::post('/tasks/{task}/start', [TaskController::class, 'start'])->name('tasks.start')->middleware('auth');
Route::post('/tasks/{task}/end', [TaskController::class, 'end'])->name('tasks.end')->middleware('auth');
