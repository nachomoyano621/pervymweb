<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PersonaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/persona/index/',[PersonaController::class,'index'])->name('persona.index');
    Route::get('persona/buscardni/',[PersonaController::class,'buscardni'])->name('persona.buscardni');
    Route::get('/persona/dnivista/',[PersonaController::class,'dnivista'])->name('persona.dnivista');
    Route::get('/persona/nombrevista/',[PersonaController::class,'nombrevista'])->name('persona.nombrevista');
    Route::get('persona/buscarnombre/',[PersonaController::class,'buscarnombre'])->name('persona.buscarnombre');
});


require __DIR__.'/auth.php';
