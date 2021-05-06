<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefDepartementController;
use App\Http\Controllers\ProfesseurController;
use App\Models\Evenement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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

Route::get('/absences/getMatiere/{idFiliere}',[ProfesseurController::class, 'getMatiere']);

Route::get('/etudiants/{filiere}', [App\Http\Controllers\ProfesseurController::class, 'Etudiants'])->name('Etudiants');

Route::get('/EtudiantsList/{filiere}', [App\Http\Controllers\ProfesseurController::class, 'getEtudiants'])->name('getEtudiantsList');

Route::get('/Etudiant/{etudiant}', [App\Http\Controllers\ProfesseurController::class, 'getEtudiant'])->name('getEtudiant');

Route::get('/Dashboard',[App\Http\Controllers\ProfesseurController::class, 'FetchDashBoardData']);

Route::get('/notes/{matiere}',[App\Http\Controllers\ProfesseurController::class, 'getNotes'])->name('Matiere');

Route::get('/NotesList/{matiere}', [App\Http\Controllers\ProfesseurController::class, 'getListNotes'])->name('getListNotes');

Route::get('/emploi/my',[App\Http\Controllers\ProfesseurController::class, 'getMyEmploi']);

Route::get('/emploi/filiere/{idFiliere}',[App\Http\Controllers\ProfesseurController::class, 'getEmploiByFiliere']);

Route::get('/note/{note}', [App\Http\Controllers\ProfesseurController::class, 'getNote']);

Route::get('/Nonote/{etudiant}', [App\Http\Controllers\ProfesseurController::class, 'getEtudiantId']);

Route::post('updateNote',[ProfesseurController::class, 'updateNote'])->name('updateNote');

Route::get('/chef/emploi',[ChefDepartementController::class, 'index']);

Route::get('/chef/etudiants/{filiere}',[ChefDepartementController::class, 'Etudiants']);

Route::get('/chef/EtudiantsList/{filiere}', [App\Http\Controllers\ChefDepartementController::class, 'getEtudiants'])->name('EtudiantsListChef');

Route::get('/chef/Etudiant/{etudiant}', [App\Http\Controllers\ChefDepartementController::class, 'getEtudiant']);

Route::post('suppetudiant',[ChefDepartementController::class, 'SupprimerEtudiant'])->name('SupprimerEtudiant');

Route::post('updateetudiant',[ChefDepartementController::class, 'UpdateEtudiant'])->name('updateEtudiant');

Route::get('/chef/matieres/{filiere}',[ChefDepartementController::class, 'Matieres']);

Route::get('/chef/notes/{matiere}',[App\Http\Controllers\ChefDepartementController::class, 'getNotes']);

Route::get('/chef/NotesList/{matiere}', [App\Http\Controllers\ChefDepartementController::class, 'getListNotes'])->name('ListNotesChef');

Route::get('/chef/professeurs/{departement}', [App\Http\Controllers\ChefDepartementController::class, 'Professeurs']);

Route::get('/chef/professeurslist/{departement}', [App\Http\Controllers\ChefDepartementController::class, 'getProfesseurs'])->name('getListProfesseurs');

Route::get('/chef/professeur/{professeur}', [App\Http\Controllers\ChefDepartementController::class, 'getProfesseur']);

Route::get('/chef/professeur/getMatiere/{professeur}/{departement}',[ChefDepartementController::class, 'getMatiere']);

Route::post('/chef/affectermatiere',[ChefDepartementController::class, 'AffecterMatiere'])->name('AffecterMatiere');

Route::post('/chef/detachermatiere',[ChefDepartementController::class, 'DetacherMatiere'])->name('DetacherMatiere');

Route::middleware(['auth','prof'])->group(function () {

});
// ===============
Route::get('/h', function () {
    // broadcast(new \App\Events\Evt())->toOthers();
    // \App\Events\Evt::dispatch();
    // event(new \App\Notifications\NotifyEvent(auth()->user,Evenement::find(1)));
    \App\Models\Evenement::factory()->create(['ID_chef'=>auth()->user()->id]);

    // return view('Chef.Notifications');


});
Route::get('/notifications', '\App\Http\Controllers\UserController@markNotification');
Route::get('profile/{user}','\App\Http\Controllers\ProfileController@show');

// ===============

Route::get('chef/emploi/filieres', [ChefDepartementController::class, 'getListOfFilieresEmploi'])->name('getFilieresEmploi');

Route::post('chef/emploi/delete/filiere', [ChefDepartementController::class, 'deleteEmploiFiliere'])->name('deleteEmploiFiliere');

Route::post('/chef/upload/',[ChefDepartementController::class, 'uploadEmploi'])->name('uploadEmploi');

Route::get('/chef/absences',[ChefDepartementController::class, 'AbsencesIndex']);

Route::get('/chef/absencesDataTable',[ChefDepartementController::class, 'getAbsencesForChef'])->name('getAbsencesForChef');

Route::get('/chef/dashboard' ,[ChefDepartementController::class, 'getChefDashboard']);

Route::get('/chef/dashboard/Absencesdatatable', [ChefDepartementController::class, 'getAbsencesListForChefDashboard'])->name('getAbsencesListForChefDashboard');

Route::get('admin/emploi', [AdminController::class, 'index']);

Route::get('admin/emploi/profs', [AdminController::class, 'getListOfProfEmploi'])->name('getProfsEmploi'); //this one isn't used by the chefdep anymore , rather it will be reused in admin's UI

Route::post('/upload/profEmploi',[AdminController::class, 'uploadEmploi'])->name('uploadEmploiprof');

Route::post('chef/emploi/delete/prof/', [AdminController::class, 'deleteEmploiProf'])->name('deleteEmploiProf');

Route::get('/admin/dashboard',[AdminController::class , 'FetchDashboardData']);

Route::get('/admin/dashboard/datatable', [AdminController::class , 'adminDashboardTable'])->name('adminDashboardTable');

Route::get('/admin/emploi/filiere', [AdminController::class , 'indexEmploiFiliere']);

Route::get('/admin/emploi/filiere/datatable', [AdminController::class , 'getAdminEmploiFiliereDatatable'])->name('getAdminEmploiFiliereDatatable');

