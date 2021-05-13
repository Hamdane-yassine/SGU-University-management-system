<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefDepartementController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return view('Chef.absences');
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

Route::post('/suppetudiant',[ChefDepartementController::class, 'SupprimerEtudiant'])->name('SupprimerEtudiant');

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

Route::get('notifications', [UserController::class,'notifs']);

Route::prefix('evenement')->group(function () {
    Route::get('create', [EvenementController::class,'create'])->name('evenement.create');
    Route::post('store', [EvenementController::class,'store'])->name('evenement.store');
    Route::get('{evenement}', [EvenementController::class,'show'])->name('evenement.show');
    Route::get('download/{evenement}', [EvenementController::class,'downloadAttachements'])->name('evenement.download');
});

Route::post('user/impersonate', [UserController::class,'impersonate']);
Route::get('user/impersonate', [UserController::class,'impersonateGet']);

Route::impersonate();
// ===============
Route::get('/{nb}', function ($nb) {
    // broadcast(new \App\Events\Evt())->toOthers();
    // \App\Events\Evt::dispatch();
    // event(new \App\Notifications\NotifyEvent(auth()->user,Evenement::find(1)));
    // \App\Models\Evenement::factory()->create(['ID_chef'=>auth()->user()->id]);
    switch ($nb) {
        case 1:
            // return Auth::user()->impersonate(User::find(3));
            return dd("asdsdasd");
            break;
        case 2:
            return view('evenements.html5-editor');
            break;
        case 3:
            return view('Chef.Notifications');
            break;

        // default:
        //     return view('Chef.absences');
        //     break;
    }

});

// Route::prefix('/notifications')->group(function () {
//     // Route::get('', [UserController::class,'Notifs']);
// });

Route::prefix('profile')->group(function () {
    Route::get('/{user}', [ProfileController::class,'show'])->name('profile.show');
    Route::post('/update/{profile}', [ProfileController::class,'update'])->name('profile.update');
    Route::post('/updateImage/', [ProfileController::class,'updateImage'])->name('profile.update.image');
    Route::post('/updatePasswd/', [ProfileController::class,'updatePasswd'])->name('profile.update.passwd');
});

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

Route::get('/chef/rattrapages',[ChefDepartementController::class , 'RattrapagesIndex']);

Route::post('/chef/rattrapages/valider/{idAbsence}', [ChefDepartementController::class ,'ValiderRatt'])->name('ValiderRatt');

Route::post('/chef/rattrapages/annuler/{idAbsence}', [ChefDepartementController::class ,'AnnulerRatt'])->name('AnnulerRatt');



//==========
Route::get('admin/filieres/{departement}', [AdminController::class, 'getFilieres']);
Route::get('admin/etudiants/{filiere}', [App\Http\Controllers\AdminController::class, 'Etudiants']);
Route::get('admin/EtudiantsList/{filiere}', [App\Http\Controllers\AdminController::class, 'getEtudiants'])->name('EtudiantsListAdmin');
Route::get('admin/Etudiant/{etudiant}', [App\Http\Controllers\AdminController::class, 'getEtudiant']);
Route::post('/admin/suppetudiant',[AdminController::class, 'SupprimerEtudiant'])->name('SupprimerEtudiantAdmin');
Route::post('/admin/updateetudiant',[AdminController::class, 'UpdateEtudiant'])->name('updateEtudiantAdmin');
Route::post('/admin/ajouteetudiant',[AdminController::class, 'AjouterEtudiant'])->name('AjouterEtudiant');
Route::get('admin/professeurs/{departement}', [App\Http\Controllers\AdminController::class, 'Professeurs']);
Route::get('admin/professeurslist/{departement}', [App\Http\Controllers\AdminController::class, 'getProfesseurs'])->name('getListProfesseursAdmin');
Route::get('/admin/professeur/{professeur}', [App\Http\Controllers\AdminController::class, 'getProfesseur']);
Route::post('suppprofesseur',[AdminController::class, 'SupprimerProfesseur'])->name('SupprimerProfesseur');
Route::post('updateprofesseur',[AdminController::class, 'UpdateProfesseur'])->name('updateProfesseur');
Route::post('ajouteprofesseur',[AdminController::class, 'AjouterProfesseur'])->name('AjouterProfesseur');
Route::post('importexcelfile',[AdminController::class, 'ImportExcelfile'])->name('ImportExcelfile');
Route::post('/admin/affecterprof',[AdminController::class, 'AffecterProfesseur'])->name('AffecterProfesseur');
Route::post('/admin/retirerprof',[AdminController::class, 'RetirerProfesseur'])->name('RetirerProfesseur');
Route::get('/admin/getAllProfs/{departement}', [App\Http\Controllers\AdminController::class, 'getAllProfesseur']);
Route::get('/admin/getProfDep/{departement}', [App\Http\Controllers\AdminController::class, 'getProfDep']);

Route::get('/admin/dashboard',[AdminController::class , 'FetchDashboardData']);

Route::get('/admin/dashboard/datatable', [AdminController::class , 'adminDashboardTable'])->name('adminDashboardTable');

Route::get('/admin/emploi/filiere', [AdminController::class , 'indexEmploiFiliere']);

Route::get('/admin/emploi/filiere/datatable', [AdminController::class , 'getAdminEmploiFiliereDatatable'])->name('getAdminEmploiFiliereDatatable');

//========

Route::get('/master/universite', [MasterController::class , 'Universite'])->name('GestionUniversite');

Route::get('/master/departements', [MasterController::class , 'getDepartements'])->name('getDepartements');

Route::post('/master/deletedepartement', [MasterController::class , 'SupprimerDepartement'])->name('SupprimerDepartement');

Route::post('/master/updatedepartement', [MasterController::class , 'UpdateDepartement'])->name('UpdateDepartement');

Route::get('/master/departement/{departement}', [MasterController::class , 'getDepartement'])->name('getDepartement');

Route::post('/master/ajoutedepartement', [MasterController::class , 'AjouterDepartement'])->name('AjouterDepartement');

Route::post('/master/ajoutefiliere', [MasterController::class , 'AjouterFiliere'])->name('AjouterFiliere');

Route::get('/master/getNewDepartements', [MasterController::class , 'getNewDepartements'])->name('getNewDepartements');

Route::post('/master/affectersemester', [MasterController::class , 'AffecterSemesteres'])->name('AffecterSemesteres');

Route::get('/master/getFilieresDep/{departement}', [MasterController::class , 'getFilieresDep'])->name('getFilieresDep');

Route::post('/master/ajoutermodule', [MasterController::class , 'AjouterModule'])->name('AjouterModule');

Route::get('/master/getSemestersFil/{filiere}', [MasterController::class , 'getSemestersFil'])->name('getSemestersFil');

Route::post('/master/ajoutermatiere', [MasterController::class , 'AjouterMatiere'])->name('AjouteMatiere');

Route::get('/master/getModulesSem/{semester}', [MasterController::class , 'getModulesSem'])->name('getModulesSem');

//=====

Route::get('/master/filiere/{idDepartement}', [MasterController::class , 'indexFilieres']);

Route::get('/master/filiere/{idDepartement}/datatable', [MasterController::class , 'getFilieresDatatable'])->name('MasterFiliereDatatable');

Route::post('/updateFiliere/{idDepartement}', [MasterController::class , 'updateFiliere']);

Route::get('/master/filiere/delete/{idFiliere}', [MasterController::class , 'deleteFiliere']);

Route::get('/master/getSemestresOfFiliere/{idFiliere}', [MasterController::class , 'getSemestresOfFiliere']);

Route::post('/master/deleteSemestreOfFiliere', [MasterController::class ,'deleteSemestreOfFiliere'])->name('deleteSemestreOfFiliere');

Route::get('/master/getModuleOfSemester/{idSemester}', [MasterController::class , 'getModuleOfSemester']);

Route::post('/master/saveModule', [MasterController::class ,'saveModule']);

Route::post('/master/saveMatiere', [MasterController::class , 'saveMatiere']);

Route::post('/master/deleteModule', [MasterController::class ,'deleteModule']);

Route::get('/master/getMatieresOfModule/{idModule}', [MasterController::class , 'getMatieresOfModule']);

Route::post('/master/deleteMatiere', [MasterController::class , 'deleteMatiere']);

Route::get('/master/dashboard', [MasterController::class , 'indexDashboard']);

Route::get('/master/dashboard/chefdepsdatatable', [MasterController::class , 'chefdepsdatatable'])->name('MasterChefDatatable');

Route::get('/master/dashboard/adminsdatatable', [MasterController::class , 'adminsdatatable'])->name('MasterAdminsDataTable');
