<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\MainController;
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

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('main');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('/votes/create', [VoteController::class, 'create'])->name('create.vote.form');
Route::post('/votes', [VoteController::class, 'store'])->name('create.vote');
Route::get('/votes/{id}', [VoteController::class, 'view'])->name('view.vote');
Route::get('/candidates/manage', [CandidateController::class, 'manage'])->name('candidates.manage');
Route::get('/manage/candidates', [CandidateController::class, 'manage'])->name('manage.candidates');
Route::get('/candidates/create', [CandidateController::class, 'create'])->name('candidates.create');
Route::post('/candidates', [CandidateController::class, 'store'])->name('candidates.store');
Route::post('/candidates/{id}/vote', [CandidateController::class, 'vote'])->name('candidates.vote');
Route::get('/candidates/{id}/edit', [CandidateController::class, 'edit'])->name('candidates.edit');
Route::put('/candidates/{id}', [CandidateController::class, 'update'])->name('candidates.update');
Route::delete('/candidates/{id}', [CandidateController::class, 'destroy'])->name('candidates.destroy');







