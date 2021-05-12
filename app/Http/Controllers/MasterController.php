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
use App\Models\Semestre;
use Illuminate\Support\Facades\Log;

class MasterController extends Controller
{
   public function Universite()
   {
      $departements = Departement::All();
      return view('master.ecole',['departements' => $departements]);
   }

   public function getDepartements(Request $request)
   {
      $departement = Departement::leftjoin('filiere', 'departement.idDepartement', '=', 'filiere.idDepartement') //retrieved matiere
         ->leftjoin('prof_departement', 'departement.idDepartement', '=', 'prof_departement.idDepartement')
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
      $emploi = array();
      $personne = array();
      foreach($departement->filieres as $filiere)
      {
         if($filiere->idEmploi!=null)
         {
            array_push($emploi,$filiere->idEmploi);
         }
         foreach($filiere->etudiants as $etudiant)
         {
            array_push($personne,$etudiant->idPersonne);
         }
      }
      $departement->delete();
      foreach($personne as $idPersonne)
      {   
         DB::table('personne')->where('idPersonne', '=', $idPersonne)->delete();
      }
      foreach($emploi as $idemploi)
      {
        $emploitodelete = Emploi::find($idemploi);
        $filename = $emploitodelete->fileName;
        Storage::delete('emploi/filiere/'.$filename);  //delete the physical file
        $emploitodelete->delete();
      }
   }
   public function getDepartement(Request $request,Departement $departement)
   {
      $departementinfo = Departement::where('departement.idDepartement',$departement->idDepartement)
      ->select('idDepartement','nom','insertion_notes')
      ->get();
      if ($request->ajax()) {
         echo json_encode($departementinfo);
     }
   }
   public function UpdateDepartement()
   {
      $idDepartement = request('upIdDep');
      $departement = Departement::find($idDepartement);
      $departement->nom=request('upnom');
      $departement->insertion_notes=request('etatnote');
      $departement->save();
   }
   public function AjouterDepartement()
   {
      $departement = new Departement;
      $departement->nom=request('ajdepnom');
      $departement->save();
   }
   public function AjouterFiliere()
   {
      $idDepartement = request('ajfildep');
      $dip = request('diplome');
      $nom = request('filnom');
      if($dip == 1 || $dip == 3)
      {
         $filiere1 = new Filiere;
         $filiere1->nom=$nom;
         $filiere1->niveau=1;
         $filiere1->idDepartement=$idDepartement;
         $filiere2 = new Filiere;
         $filiere2->nom=$nom;
         $filiere2->niveau=2;
         $filiere2->idDepartement=$idDepartement;
         $filiere1->save();
         $filiere2->save();
      }else{
         $filiere = new Filiere;
         $filiere->nom=$nom;
         $filiere->niveau=1;
         $filiere->idDepartement=$idDepartement;
         $filiere->save();
      }
   }

   public function getNewDepartements()
   {
      $departements=Departement::All()->toArray();
      echo json_encode($departements);
   }
   public function getFilieresDep(Departement $departement)
   {
      echo json_encode($departement->filieres);
   }
   public function AffecterSemesteres()
   {
      $idFiliere=request('semfil');
      $semesteres = request('semester');
      $annee = date("Y")."/".(date("Y")-1);
      foreach($semesteres as $semester)
      {
         $semesterToInsert = new Semestre;
         $semesterToInsert->nom=$semester;
         $semesterToInsert->idFiliere=$idFiliere;
         $semesterToInsert->Annee_universaitaire=$annee;
         $semesterToInsert->save();
      }
   }
   public function getSemestersFil(Filiere $filiere)
   {
      echo json_encode($filiere->semestres);
   }
   public function AjouterModule()
   {
      $idFiliere = request('modfil');
      $idSemester = request('modsem');
      $module = new Module;
      $module->idFiliere=$idFiliere;
      $module->idSemestre=$idSemester;
      $module->nom=request('modnom');
      $module->vh=request('modvh');
      $module->save();
   }
   public function getModulesSem(Semestre $semester)
   {
      echo json_encode($semester->modules);
   }
   public function AjouterMatiere()
   {
      $idModule = request('matmod');
      $matiere = new Matiere;
      $matiere->idModule=$idModule;
      $matiere->nom=request('matnom');
      $matiere->vh=request('matvh');
      $matiere->save();
   }
   public function indexFilieres($idDepartement)
   {
      //get list of filieres in that departement
      $filieres = Filiere::where('idDepartement', $idDepartement)->get();

      return view('master.filiere', ['idDepartement' => $idDepartement, 'filieres' => $filieres]);
   }

   public function getFilieresDatatable(Request $request, $idDepartement)
   {
      $filieres = Filiere::where('filiere.idDepartement', $idDepartement)
         ->join('etudiant', 'etudiant.idFiliere', 'filiere.idFiliere')
         ->groupBy('filiere.idFiliere')
         ->select('filiere.idFiliere as idFiliere', 'filiere.nom as nomFiliere', 'filiere.niveau as niveau', DB::raw('COUNT(*) as CountEtudiant'))->get();

      if ($request->ajax()) {
         return Datatables::of($filieres)
            ->addColumn('action', function ($row) {
               $btn = '<a style="color: #265ed7" class="color-light-blue" data-toggle="modal" data-target="#exampleModal" onclick="initModal(' . $row->idFiliere . ')"><i class="icon-copy dw dw-edit2"></a>';

               return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
      }
   }

   public function updateFiliere(Request $request, $idDepartement)
   {
      echo 'idFiliere to update : ' . $request->idFiliere . ' nom: ' . $request->nomFiliere . ' niv : ' . $request->niveau;

      if (is_null($request->idFiliere) || (is_null($request->niveau) && is_null($request->nomFiliere))) return view('master.filiere');

      $filiere = Filiere::find($request->idFiliere);
      if (!is_null($request->nomFiliere)) $filiere->nom = $request->nomFiliere;
      if (!is_null($request->niveau)) $filiere->niveau = $request->niveau;
      $filiere->save();

      return redirect('/master/filiere/' . $idDepartement);
   }

}
