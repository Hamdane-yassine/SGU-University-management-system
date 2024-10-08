<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefDepartementController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Chefdep;
use App\Models\Evenement;
use App\Models\Matiere;
use App\Models\Professeur;
use App\Models\User;
use App\Notifications\NotifyEmailChanged;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;
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

Route::get('/1', function () {
    // return dd(Chefdep::find(auth()->user()->professeur->chefdep->ID_chef)->ID_chef, Professeur::find(1)->chefdep->ID_chef);
    dd(auth()->user()->professeur->matieres[0]->module->semestre->idFiliere);
});

Auth::routes();

Route::get('/', function () {
    $role = Auth::user()->role;
    switch ($role) {
        case 'master':
            return redirect('master/dashboard');
            break;
        case 'chefdep':
            return redirect('chef/dashboard');
            break;
        case 'prof':
            return redirect('Dashboard');
            break;
        case 'admin':
            return redirect('admin/dashboard');
            break;
        default:
            return redirect('/login');
            break;
    }
})->middleware('auth');


Route::middleware(['auth','prof'])->group(function () {
    Route::post('addRatt', [ProfesseurController::class, 'addRatt']);
    Route::get('/absences', [ProfesseurController::class, 'index']);
    Route::get('/AbsencesList', [ProfesseurController::class, 'getAbsences'])->name('getAbsencesList');
    Route::get('/absences/getMatiere/{filiere}', [ProfesseurController::class, 'getMatiere'])->middleware('can:view,filiere');
    Route::get('/etudiants/{filiere}', [App\Http\Controllers\ProfesseurController::class, 'Etudiants'])->name('Etudiants')->middleware('can:view,filiere');
    Route::get('/EtudiantsList/{filiere}', [App\Http\Controllers\ProfesseurController::class, 'getEtudiants'])->name('getEtudiantsList')->middleware('can:view,filiere');
    Route::get('/Etudiant/{etudiant}', [App\Http\Controllers\ProfesseurController::class, 'getEtudiant'])->name('getEtudiant')->middleware('can:view,etudiant');
    Route::get('/Dashboard', [App\Http\Controllers\ProfesseurController::class, 'FetchDashBoardData']);
    Route::get('/notes/{matiere}', [App\Http\Controllers\ProfesseurController::class, 'getNotes'])->name('Matiere')->middleware('can:view,matiere');
    Route::get('/NotesList/{matiere}', [App\Http\Controllers\ProfesseurController::class, 'getListNotes'])->name('getListNotes');
    Route::get('/emploi/my', [App\Http\Controllers\ProfesseurController::class, 'getMyEmploi']);
    Route::get('/emploi/filiere/{filiere}', [App\Http\Controllers\ProfesseurController::class, 'getEmploiByFiliere'])->middleware('can:view,filiere');
    Route::get('/note/{note}', [App\Http\Controllers\ProfesseurController::class, 'getNote'])->middleware('can:view,note');
    Route::get('/Nonote/{etudiant}', [App\Http\Controllers\ProfesseurController::class, 'getEtudiantId'])->middleware('can:view,etudiant');
    Route::post('updateNote', [ProfesseurController::class, 'updateNote'])->name('updateNote');
});

Route::middleware(['auth','chefdep'])->group(function () {
    Route::get('/chef/emploi', [ChefDepartementController::class, 'index']);
    Route::get('/chef/etudiants/{filiere}', [ChefDepartementController::class, 'Etudiants'])->middleware('can:view,filiere');
    Route::get('/chef/EtudiantsList/{filiere}', [App\Http\Controllers\ChefDepartementController::class, 'getEtudiants'])->name('EtudiantsListChef')->middleware('can:view,filiere');
    Route::get('/chef/Etudiant/{etudiant}', [App\Http\Controllers\ChefDepartementController::class, 'getEtudiant'])->middleware('can:view,etudiant');
    Route::post('/suppetudiant', [ChefDepartementController::class, 'SupprimerEtudiant'])->name('SupprimerEtudiant');
    Route::post('updateetudiant', [ChefDepartementController::class, 'UpdateEtudiant'])->name('updateEtudiant');
    Route::post('envoyerresultats', [ChefDepartementController::class, 'EnvoyerNotes'])->name('EnvoyerResultats');
    Route::post('envoyerresultatetudiant', [ChefDepartementController::class, 'EnvoyerNote'])->name('EnvoyerResultatEtudiant');
    Route::get('/chef/matieres/{filiere}', [ChefDepartementController::class, 'Matieres'])->middleware('can:view,filiere');
    Route::get('/chef/notes/{matiere}', [App\Http\Controllers\ChefDepartementController::class, 'getNotes']);
    Route::get('/chef/NotesList/{matiere}', [App\Http\Controllers\ChefDepartementController::class, 'getListNotes'])->name('ListNotesChef');
    Route::get('/chef/professeurs/{departement}', [App\Http\Controllers\ChefDepartementController::class, 'Professeurs'])->middleware('can:view,departement');
    Route::get('/chef/professeurslist/{departement}', [App\Http\Controllers\ChefDepartementController::class, 'getProfesseurs'])->name('getListProfesseurs')->middleware('can:view,departement');
    Route::get('/chef/professeur/{professeur}', [App\Http\Controllers\ChefDepartementController::class, 'getProfesseur'])->middleware('can:view,professeur');
    Route::get('/chef/professeur/getMatiere/{professeur}/{departement}', [ChefDepartementController::class, 'getMatiere'])->middleware('can:view,departement');
    Route::post('/chef/affectermatiere', [ChefDepartementController::class, 'AffecterMatiere'])->name('AffecterMatiere');
    Route::post('/chef/detachermatiere', [ChefDepartementController::class, 'DetacherMatiere'])->name('DetacherMatiere');
    Route::post('/chef/transetudiant', [ChefDepartementController::class, 'TransEtudiants'])->name('transEtudiants');
    Route::get('/chef/loadselects/{filiere}', [ChefDepartementController::class, 'getEtudiantsForSelects'])->name('getEtudiantsForSelects')->middleware('can:view,filiere');
    Route::get('chef/emploi/filieres', [ChefDepartementController::class, 'getListOfFilieresEmploi'])->name('getFilieresEmploi');
    Route::post('chef/emploi/delete/filiere', [ChefDepartementController::class, 'deleteEmploiFiliere'])->name('deleteEmploiFiliere');
    Route::post('/chef/upload/', [ChefDepartementController::class, 'uploadEmploi'])->name('uploadEmploi');
    Route::get('/chef/absences', [ChefDepartementController::class, 'AbsencesIndex']);
    Route::get('/chef/absencesDataTable', [ChefDepartementController::class, 'getAbsencesForChef'])->name('getAbsencesForChef');
    Route::get('/chef/dashboard', [ChefDepartementController::class, 'getChefDashboard']);
    Route::get('/chef/dashboard/Absencesdatatable', [ChefDepartementController::class, 'getAbsencesListForChefDashboard'])->name('getAbsencesListForChefDashboard');
    Route::get('/chef/rattrapages', [ChefDepartementController::class, 'RattrapagesIndex']);
    // start to verify
    Route::post('/chef/rattrapages/valider/{absence}', [ChefDepartementController::class, 'ValiderRatt'])->name('ValiderRatt')->middleware('can:update,absence');
    Route::post('/chef/rattrapages/annuler/{absence}', [ChefDepartementController::class, 'AnnulerRatt'])->name('AnnulerRatt')->middleware('can:update,absence');
    // end to verify
    Route::get('chef/mode', [ChefDepartementController::class, 'mode'])->name('chef.mode');
    Route::get('/chef/resultat/{etudiant}', [ChefDepartementController::class, 'getResulatEtudiant'])->middleware('can:view,etudiant');
});


Route::get('notifications', [UserController::class, 'notifs']);
Route::get('notifications/markAllAsRead/{user}', [UserController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');


Route::prefix('evenement')->group(function () {
    Route::get('/', [EvenementController::class, 'index'])->name('evenement.index');
    Route::get('create', [EvenementController::class, 'create'])->name('evenement.create');
    Route::post('store', [EvenementController::class, 'store'])->name('evenement.store');
    Route::post('update/{evenement}', [EvenementController::class, 'update'])->name('evenement.update');
    Route::get('edit/{evenement}', [EvenementController::class, 'edit'])->name('evenement.edit');
    Route::get('delete/{evenement}', [EvenementController::class, 'delete'])->name('evenement.delete');
    Route::get('{evenement}', [EvenementController::class, 'show'])->name('evenement.show');
    Route::get('download/{evenement}', [EvenementController::class, 'downloadAttachements'])->name('evenement.download');
});

Route::impersonate();
Route::post('user/impersonate', [UserController::class, 'impersonate']);
Route::get('user/impersonate', [UserController::class, 'impersonateGet']);

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    request()->user()->notify(new NotifyEmailChanged);
    return redirect('/profile/' . Auth::user()->getAuthIdentifier());
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::prefix('profile')->middleware(['auth'])->group(function () {
    Route::get('/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/update/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/updateImage/', [ProfileController::class, 'updateImage'])->name('profile.update.image');
    Route::post('/updatePasswd/', [ProfileController::class, 'updatePasswd'])->name('profile.update.passwd');
    Route::post('/updateInfo/{profile}', [ProfileController::class, 'updateInfo'])->name('profile.update.info');
});

// ===============

Route::middleware(['admin','auth'])->group(function () {
    Route::get('admin/emploi', [AdminController::class, 'index']);
    Route::get('admin/emploi/profs', [AdminController::class, 'getListOfProfEmploi'])->name('getProfsEmploi'); //this one isn't used by the chefdep anymore , rather it will be reused in admin's UI
    Route::post('/upload/profEmploi', [AdminController::class, 'uploadEmploi'])->name('uploadEmploiprof');
    Route::post('admin/emploi/delete/prof/', [AdminController::class, 'deleteEmploiProf'])->name('deleteEmploiProf');
    Route::get('admin/filieres/{departement}', [AdminController::class, 'getFilieres']);
    Route::get('admin/etudiants/{filiere}', [App\Http\Controllers\AdminController::class, 'Etudiants']);
    Route::get('admin/EtudiantsList/{filiere}', [App\Http\Controllers\AdminController::class, 'getEtudiants'])->name('EtudiantsListAdmin');
    Route::get('admin/Etudiant/{etudiant}', [App\Http\Controllers\AdminController::class, 'getEtudiant']);
    Route::post('/admin/suppetudiant', [AdminController::class, 'SupprimerEtudiant'])->name('SupprimerEtudiantAdmin');
    Route::post('/admin/updateetudiant', [AdminController::class, 'UpdateEtudiant'])->name('updateEtudiantAdmin');
    Route::post('/admin/ajouteetudiant', [AdminController::class, 'AjouterEtudiant'])->name('AjouterEtudiant');
    Route::get('admin/professeurs/{departement}', [App\Http\Controllers\AdminController::class, 'Professeurs']);
    Route::get('admin/professeurslist/{departement}', [App\Http\Controllers\AdminController::class, 'getProfesseurs'])->name('getListProfesseursAdmin');
    Route::get('/admin/professeur/{professeur}', [App\Http\Controllers\AdminController::class, 'getProfesseur']);
    Route::post('suppprofesseur', [AdminController::class, 'SupprimerProfesseur'])->name('SupprimerProfesseur');
    Route::post('updateprofesseur', [AdminController::class, 'UpdateProfesseur'])->name('updateProfesseur');
    Route::post('ajouteprofesseur', [AdminController::class, 'AjouterProfesseur'])->name('AjouterProfesseur');
    Route::post('importexcelfile', [AdminController::class, 'ImportExcelfile'])->name('ImportExcelfile');
    Route::post('/admin/affecterprof', [AdminController::class, 'AffecterProfesseur'])->name('AffecterProfesseur');
    Route::post('/admin/retirerprof', [AdminController::class, 'RetirerProfesseur'])->name('RetirerProfesseur');
    Route::get('/admin/getAllProfs/{departement}', [App\Http\Controllers\AdminController::class, 'getAllProfesseur']);
    Route::get('/admin/getProfDep/{departement}', [App\Http\Controllers\AdminController::class, 'getProfDep']);
    Route::get('/admin/dashboard', [AdminController::class, 'FetchDashboardData']);
    Route::get('/admin/dashboard/datatable', [AdminController::class, 'adminDashboardTable'])->name('adminDashboardTable');
    Route::get('/admin/emploi/filiere', [AdminController::class, 'indexEmploiFiliere']);
    Route::get('/admin/emploi/filiere/datatable', [AdminController::class, 'getAdminEmploiFiliereDatatable'])->name('getAdminEmploiFiliereDatatable');
});

Route::middleware(['auth','master'])->group(function () {
    Route::get('/master/universite', [MasterController::class, 'Universite'])->name('GestionUniversite');
    Route::get('/master/departements', [MasterController::class, 'getDepartements'])->name('getDepartements');
    Route::post('/master/deletedepartement', [MasterController::class, 'SupprimerDepartement'])->name('SupprimerDepartement');
    Route::post('/master/updatedepartement', [MasterController::class, 'UpdateDepartement'])->name('UpdateDepartement');
    Route::get('/master/departement/{departement}', [MasterController::class, 'getDepartement'])->name('getDepartement');
    Route::post('/master/ajoutedepartement', [MasterController::class, 'AjouterDepartement'])->name('AjouterDepartement');
    Route::post('/master/enregistrervars', [MasterController::class, 'EnregistrerVars'])->name('EnregistrerVars');
    Route::post('/master/ajoutefiliere', [MasterController::class, 'AjouterFiliere'])->name('AjouterFiliere');
    Route::get('/master/getNewDepartements', [MasterController::class, 'getNewDepartements'])->name('getNewDepartements');
    Route::post('/master/affectersemester', [MasterController::class, 'AffecterSemesteres'])->name('AffecterSemesteres');
    Route::get('/master/getFilieresDep/{departement}', [MasterController::class, 'getFilieresDep'])->name('getFilieresDep');
    Route::post('/master/ajoutermodule', [MasterController::class, 'AjouterModule'])->name('AjouterModule');
    Route::get('/master/getSemestersFil/{filiere}', [MasterController::class, 'getSemestersFil'])->name('getSemestersFil');
    Route::post('/master/ajoutermatiere', [MasterController::class, 'AjouterMatiere'])->name('AjouteMatiere');
    Route::get('/master/getModulesSem/{semester}', [MasterController::class, 'getModulesSem'])->name('getModulesSem');
    Route::get('/master/filiere/{idDepartement}', [MasterController::class, 'indexFilieres']);
    Route::get('/master/filiere/{idDepartement}/datatable', [MasterController::class, 'getFilieresDatatable'])->name('MasterFiliereDatatable');
    Route::post('/updateFiliere/{idDepartement}', [MasterController::class, 'updateFiliere']);
    Route::post('/master/filiere/delete', [MasterController::class, 'deleteFilierebyId'])->name('deleteFiliere');
    Route::get('/master/filiere/delete/{idFiliere}', [MasterController::class, 'deleteFiliere']);
    Route::get('/master/getSemestresOfFiliere/{idFiliere}', [MasterController::class, 'getSemestresOfFiliere']);
    Route::post('/master/deleteSemestreOfFiliere', [MasterController::class, 'deleteSemestreOfFiliere'])->name('deleteSemestreOfFiliere');
    Route::get('/master/getModuleOfSemester/{idSemester}', [MasterController::class, 'getModuleOfSemester']);
    Route::post('/master/saveModule', [MasterController::class, 'saveModule']);
    Route::post('/master/saveMatiere', [MasterController::class, 'saveMatiere']);
    Route::post('/master/deleteModule', [MasterController::class, 'deleteModule']);
    Route::get('/master/getMatieresOfModule/{idModule}', [MasterController::class, 'getMatieresOfModule']);
    Route::post('/master/deleteMatiere', [MasterController::class, 'deleteMatiere']);
    Route::get('/master/dashboard', [MasterController::class, 'indexDashboard']);
    Route::get('/master/dashboard/chefdepsdatatable', [MasterController::class, 'chefdepsdatatable'])->name('MasterChefDatatable');
    Route::get('/master/dashboard/adminsdatatable', [MasterController::class, 'adminsdatatable'])->name('MasterAdminsDataTable');
    Route::get('/master/admins', [MasterController::class, 'adminsIndex'])->name('MasterAdminsIndex');
    Route::get('/master/admin/{idAdmin}', [MasterController::class, 'getAdminById']);
    Route::post('/master/admin/updateAdmin', [MasterController::class, 'updateAdmin'])->name('updateAdmin');
    Route::post('/master/admin/deleteadmin', [MasterController::class, 'deletAdmin'])->name('deleteAdmin');
    Route::post('/master/admin/AjouterAdmin', [MasterController::class, 'AjouterAdmin'])->name('AjouterAdmin');
});

