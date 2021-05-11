<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Str;
use App\Jobs\SendAccountEmail;
use App\Models\Absence;
use App\Models\Chefdep;
use App\Models\Emploi;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\User;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Module;
use App\Models\Personne;
use App\Models\Prof_departement;
use App\Models\Professeur;
use Faker\Provider\ar_JO\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportEtudiants;
use Illuminate\Support\Facades\Log;

class MasterController extends Controller
{
   public function Universite()
   {
      return view('master.ecole');
   }

   public function getDepartements(Request $request)
   {
      $departement = Departement::join('filiere', 'departement.idDepartement', '=', 'filiere.idDepartement') //retrieved matiere
         ->join('prof_departement', 'departement.idDepartement', '=', 'prof_departement.idDepartement')
         ->select('departement.idDepartement', 'departement.nom', 'departement.insertion_notes', DB::raw('COUNT(DISTINCT filiere.idFiliere) as NBfiliere'), DB::raw('COUNT(DISTINCT prof_departement.idProfDep) as NBprofesseurs'))
         ->groupBy('departement.idDepartement', 'departement.nom', 'departement.insertion_notes')
         ->get();
      if ($request->ajax()) {
         return Datatables::of($departement)
            ->make(true);
      }
   }

   public function SupprimerDepartement()
   {
      $departement = Departement::find(request('idDep'));
      foreach ($departement->filieres as $filiere) {
         foreach ($filiere->semestres as $semestre) {
            foreach ($semestre->modules as $module) {
               foreach ($module->matieres as $matiere) {
                  DB::table('absence')->where('idMatiere', '=', $matiere->idMatiere)->delete();
                  DB::table('note')->where('idMatiere', '=', $matiere->idMatiere)->delete();
                  DB::table('matiere')->where('idMatiere', '=', $matiere->idMatiere)->delete();
               }
               DB::table('module')->where('idModule', '=', $module->idModule)->delete();
            }
            DB::table('semestre')->where('idSemestre', '=', $semestre->idSemestre)->delete();
         }
         foreach ($filiere->etudiants as $etudiant) {
            DB::table('note')->where('idEtudiant', '=', $etudiant->idEt)->delete();
            $Idpersonne = $etudiant->personne->idPersonne;
            DB::table('etudiant')->where('idEtudiant', '=', $etudiant->idEtudiant)->delete();
            DB::table('personne')->where('idPersonne', '=', $Idpersonne)->delete();
         }
         DB::table('filiere')->where('idFiliere', '=', $filiere->idFiliere)->delete();
      }
      DB::table('prof_departement')->where('idDepartement', '=', $departement->idDepartement)->delete();
      $idChef = $departement->chefdep->idProf;
      DB::table('chefdep')->where('idDepartement', '=', $departement->idDepartement)->delete();
      DB::table('departement')->where('idDepartement', '=', $departement->idDepartement)->delete();
      $professeur = Professeur::find($idChef);
      $idUtilisateur = $professeur->idUtilisateur;
      $user = User::find($idUtilisateur);
      $user->role="prof";
      $user->save();
   }
}
