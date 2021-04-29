<?php

use App\Http\Controllers\ProfesseurController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/absences',[ProfesseurController::class, 'getAllData']);

Route::post('addRatt',[ProfesseurController::class, 'addRatt']);

Route::get('/absences',[ProfesseurController::class, 'index']);

Route::get('/AbsencesList',[ProfesseurController::class, 'getAbsences'])->name('getAbsencesList');

Route::get('/etudiants/{filiere}', [App\Http\Controllers\ProfesseurController::class, 'getEtudiants'])->name('Etudiants');
