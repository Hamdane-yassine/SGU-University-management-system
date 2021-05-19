<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
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
use DataTables;
use Egulias\EmailValidator\Exception\UnclosedComment;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportEtudiants;
use App\Models\Profile;
use App\Models\Semestre;
use Illuminate\Support\Facades\Log;

class MasterController extends Controller
{

    public function __construct()
    {
        $this->middleware(['master']);
    }

    public function indexFilieres($idDepartement)
    {
        //get list of filieres in that departement
        $filieres = Filiere::where('idDepartement',$idDepartement)->get();

        //get list of semesters
        $Semestres = Semestre::where('filiere.idDepartement', $idDepartement)
            ->join('filiere','filiere.idFiliere','semestre.idFiliere')
            ->select('idSemestre as id','semestre.num')->get();

        return view('master.filiere',['idDepartement' => $idDepartement, 'filieres' => $filieres, 'Semestres' => $Semestres ]);
    }

    public function getFilieresDatatable(Request $request,$idDepartement)
    {
        $filieres = Filiere::where('filiere.idDepartement',$idDepartement)
        ->leftJoin('etudiant','etudiant.idFiliere','filiere.idFiliere')
        ->groupBy('filiere.idFiliere')
        ->select('filiere.idFiliere as idFiliere','filiere.nom as nomFiliere','diplome','shortcut','filiere.niveau as niveau',DB::raw('COUNT(*) as CountEtudiant'))->get();

        if($request->ajax()) {
            return Datatables::of($filieres)
            ->addColumn('action', function($row)
            {
                $btn = '<span class="dtr-data">
                                <div class="table-actions pl-1">
                                    <a href="#" style="color: #265ed7" data-toggle="modal" data-target="#exampleModal" onclick="initModal('.$row->idFiliere.')">
                                        <i class="icon-copy dw dw-edit2"></i>
                                    </a>
                                    <a href="/master/filiere/delete/'.$row->idFiliere.'" style="color : #e95959" type="button">
                                        <i class="icon-copy dw dw-delete-3"></i>
                                    </a>
                                </div>
                            </span>';
                /*$btn = '<div class="table-actions pl-1">
                            <a href="#" style="color: #265ed7" data-toggle="modal" data-target="#exampleModal" onclick="initModal('.$row->idFiliere.')><i class="icon-copy dw dw-edit2"></i></a>
                            <a href="/master/filiere/delete/'.$row->idFiliere.'" style="color : #e95959" onclick="setDepId(10)" data-toggle="tooltip" >
                                <i class="icon-copy dw dw-delete-3"></i>
                            </a>
                        </div>';*/
                /*$btn = '<ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" data-target="#exampleModal" onclick="initModal('.$row->idFiliere.')" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                            </li>
                            <li class="list-inline-item">
                                <a href="/master/filiere/delete/'.$row->idFiliere.'"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                            </li>
                        </ul>';*/

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
      }
   }

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

   public function getDepartement(Request $request,Departement $departement)
   {
      $departement = Departement::where('departement.idDepartement',$departement->idDepartement) //retrieved matiere
         ->select('departement.idDepartement', 'departement.nom', 'departement.insertion_notes')
         ->get();
      if ($request->ajax()) {
         echo json_encode($departement);
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
      $rac = request('rac');
      if($dip == "DEUG" || $dip == "DUT" ||$dip == "master")
      {
         $filiere1 = new Filiere;
         $filiere1->nom=$nom;
         $filiere1->niveau=1;
         $filiere1->diplome=$dip;
         $filiere1->idDepartement=$idDepartement;
         $filiere2 = new Filiere;
         $filiere2->nom=$nom;
         $filiere2->niveau=2;
         $filiere2->diplome=$dip;
         $filiere2->idDepartement=$idDepartement;
         $filiere1->shortcut=$rac;
         $filiere2->shortcut=$rac;
         $filiere1->save();
         $filiere2->save();
      }else{
         $filiere = new Filiere;
         $filiere->nom=$nom;
         $filiere->niveau=1;
         $filiere->shortcut=$rac;
         $filiere->diplome=$dip;
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
         $semesterToInsert->num=$semester;
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
      $idSemester = request('modsem');
      $module = new Module;
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
      $matiere->coeff=request('coef');
      $matiere->vh=request('matvh');
      $matiere->save();
   }

   public function updateFiliere(Request $request, $idDepartement)
   {
      echo 'idFiliere to update : ' . $request->idFiliere . ' nom: ' . $request->nomFiliere . ' niv : ' . $request->niveau;

      if (is_null($request->idFiliere) || (is_null($request->niveau) && is_null($request->nomFiliere) && is_null($request->rac) && is_null($request->dip))) return redirect('/master/filiere/' . $idDepartement);

      $filiere = Filiere::find($request->idFiliere);
      if (!is_null($request->nomFiliere)) $filiere->nom = $request->nomFiliere;
      if (!is_null($request->niveau)) $filiere->niveau = $request->niveau;
      if (!is_null($request->dip)) $filiere->diplome = $request->dip;
      if (!is_null($request->rac)) $filiere->shortcut = $request->rac;
      $filiere->save();

      return redirect('/master/filiere/' . $idDepartement);
   }

    public function deleteFiliere(Request $request,$idFiliere)
    {
        Filiere::destroy($idFiliere);
        return redirect()->back();
    }


    public function getSemestresOfFiliere($idFiliere)
    {
        $Semestres = Semestre::where('idFiliere',$idFiliere)->select('idSemestre as id','num')->get()->toArray();
        //echo $MatieresList;
        return json_encode($Semestres);
    }

    public function deleteSemestreOfFiliere(Request $request)
    {
        Semestre::destroy($request->semestre1);
        return redirect()->back();
    }

    public function getModuleOfSemester($idSemester)
    {
        //given a semester id , you retrieve a filiere , and find its modules
        $semester = Semestre::find($idSemester);
        $Modules = Module::where('module.idSemestre',$semester->idSemestre)
        ->select('module.idModule as idModule','module.nom as name')->get()->toArray();

        return json_encode($Modules);
    }

    public function saveModule(Request $request)
    {
        $idSemester = $request->semestre2;
        $idModule = $request->module2;
        $newName = $request->NomModule2;
        $vh = $request->VH2;

        if(is_null($newName) && is_null($vh)) return redirect()->back();

        $module = Module::find($idModule);

        if(!is_null($newName)) $module->nom = $newName;
        if(!is_null($vh))      $module->vh = $vh;
        $module->save();
        return redirect()->back();
    }

    public function deleteModule(Request $request)
    {
        Module::destroy($request->module2);  //deleting a module leads to the deletion of all matiers included in it
        return redirect()->back();
    }

    public function getMatieresOfModule($idModule)
    {
        //return matiers of a module
        $matiers = Matiere::where('idModule',$idModule)
        ->select('idMatiere','nom as name')->get();

        return json_encode($matiers);
    }

    public function saveMatiere(Request $request)
    {
        $idMatiere = $request->matiere3;
        $newNomMatiere = $request->nom3;
        $newVH = $request->vh3;
        $newCoeff = $request->coeff3;

        $Matiere = Matiere::find($idMatiere);

        if(!is_null($newNomMatiere)) $Matiere->nom = $newNomMatiere;
        if(!is_null($newVH))         $Matiere->vh = $newVH;
        if(!is_null($newCoeff))      $Matiere->coeff = $newCoeff;

        $Matiere->save();

        return redirect()->back();
    }

    public function deleteMatiere(Request $request)
    {
        $matiere = Matiere::destroy($request->matiere3);
        return redirect()->back();
    }

    public function indexDashboard()
    {
        $annee = date("Y")."/".(date("Y")-1);
        $date = date("j/n/Y");
        $Count_dep = Departement::all()->count();
        $Count_prof = Professeur::all()->count();
        $Count_etudiant = Etudiant::all()->count();
        $Count_filiere = Filiere::all()->count();

        return view('master.TableBoard', ['annee' => $annee, 'date' => $date, 'Count_dep' => $Count_dep, 'Count_prof' => $Count_prof
        , 'Count_etudiant' => $Count_etudiant, 'Count_filiere' => $Count_filiere]);
    }

    public function chefdepsdatatable(Request $request)
    {
        $chefs = Chefdep::join('professeur','professeur.idProf','chefdep.idProf')
        ->join('users','users.id','professeur.idProf')
        ->join('personne','personne.idPersonne','users.idPersonne')
        ->join('departement','departement.idDepartement','chefdep.idDepartement')
        ->select('chefdep.ID_chef as id','personne.nom as name','departement.nom as DepName');
        if ($request->ajax()) {
           return Datatables::of($chefs)
              ->make(true);
        }
    }

    public function adminsdatatable(Request $request)
    {
        $admins = User::where('role','admin')
        ->join('personne','personne.idPersonne','users.idPersonne')
        ->select('users.id as id','personne.nom as name', 'users.email as email', 'personne.prenom as prenom' ,'personne.tel as tel')->get();

        if ($request->ajax()) {
            return Datatables::of($admins)
               ->make(true);
         }
    }

    public function adminsIndex()
    {
        return view('master.admins');
    }

    public function getAdminById(Request $request,$idAdmin) //id user
    {
        $admin = User::where('users.id',$idAdmin)
            ->join('personne', 'users.idPersonne', '=', 'personne.idPersonne')
            ->select('users.id', 'personne.nom', 'personne.prenom', 'role',
             'email', 'tel', 'dateNaissance', 'nationalite', 'lieuNaissance', 'situationFamiliale', 'genre', 'cin', 'adressePersonnele', 'emailInstitutionne')
            ->get();

        $data = array();
        $data['admin'] = $admin;

        if ($request->ajax()) {
            echo json_encode($data);
        }
    }

    public function updateAdmin(Request $request)
    {
        /*echo dd($admin = User::find($request->inidAdmin));
        echo '<br>new Atts : ';
        echo '<br>';
        echo 'id Admin : '.$request->inidAdmin;
        echo '<br>';
        echo 'name : '.$request->innom;
        echo '<br>';
        echo 'prenom : '.$request->inprenom;
        echo '<br>';
        echo 'genre : '.$request->ingenre;
        echo '<br>';
        echo 'dat naisace : '.$request->indatenais;
        echo '<br>';
        echo 'situation : '.$request->insituation;
        echo '<br>';
        echo 'nationalite : '.$request->innationalite;
        echo '<br>';
        echo 'Lieu naissace : '.$request->inLieuNaissance;
        echo '<br>';
        echo 'cin : '.$request->incin;
        echo '<br>';
        echo 'Adresse : '.$request->inadresse;
        echo '<br>';
        echo 'tel : '.$request->intel;
        echo '<br>';
        echo 'email perso : '.$request->inemail;
        echo '<br>';
        echo 'email inst : '.$request->inemailins;*/

        $admin = User::find($request->inidAdmin);
        $personne = $admin->personne;
        request()->validate(
            [
                'inidAdmin' => 'required',
                'innom' => 'required',
                'inprenom' => 'required',
                'insituation' => 'required',
                'ingenre' => 'required',
                'indatenais' => ['required', 'date'],
                'innationalite' => 'required',
                'inLieuNaissance' => 'required',
                'inadresse' => 'required',
                'incin' => 'required|unique:personne,cin,' . $personne->idPersonne . ',idPersonne',
                'intel' => 'required',
                'inemail' => 'required|email|unique:users,email,' . $admin->id,
                'inemailins' => 'required|email|unique:personne,emailInstitutionne,' . $personne->idPersonne . ',idPersonne',
            ],
            [
                'incin.unique' => 'C.N.I.E est déjà existé.',
                'inemail.unique' => 'Email est déjà utilisé.',
                'inemailins.unique' => 'Email est déjà utilisé.',
                'inemail.email' => 'Email invalide.',
                'inemailins.email' => 'Email invalide.'
            ]
        );
        $admin->email = $request->inemail;
        $admin->save();

        $personne->nom = $request->innom;
        $personne->prenom = $request->inprenom;
        $personne->genre = $request->ingenre;
        $personne->dateNaissance = $request->indatenais;
        $personne->situationFamiliale = $request->insituation;
        $personne->nationalite = $request->innationalite;
        $personne->lieuNaissance = $request->inLieuNaissance;
        $personne->cin = $request->incin;
        $personne->adressePersonnele = $request->inadresse;
        $personne->tel = $request->intel;
        $personne->emailInstitutionne = $request->inemailins;

        $personne->save();
    }

    public function deletAdmin(Request $request)
    {
        $user = User::find($request->idAdmin);
        $personne = $user->personne;
        $toDestroy = $personne->idPersonne;
        Personne::destroy($toDestroy);
    }

    public function AjouterAdmin(Request $request)
    {
        request()->validate(
            [
                'ajnom' => 'required',
                'ajprenom' => 'required',
                'ajsituation' => 'required',
                'ajgenre' => 'required',
                'ajdatenais' => ['required', 'date'],
                'ajnationalite' => 'required',
                'ajLieuNaissance' => 'required',
                'ajadresse' => 'required',
                'ajcin' => ['required', 'unique:personne,cin'],
                'ajtel' => 'required',
                'ajemail' => ['required', 'email', 'unique:users,email'],
                'ajemailins' => ['required', 'email', 'unique:personne,emailInstitutionne'],
            ],
            [
                'ajcin.unique' => 'C.N.I.E est déjà existé.',
                'ajemail.unique' => 'Email est déjà utilisé.',
                'ajemailins.unique' => 'Email est déjà utilisé.',
                'ajemail.email' => 'Email invalide.',
                'ajemailins.email' => 'Email invalide.'
            ]
        );

        //first create the person
        $personne = new Personne;
        $personne->nom = $request->ajnom;
        $personne->prenom = $request->ajnom;
        $personne->genre = $request->ajgenre;
        $personne->dateNaissance = $request->ajdatenais;
        $personne->situationFamiliale = $request->ajsituation;
        $personne->nationalite = $request->ajnationalite;
        $personne->lieuNaissance = $request->ajLieuNaissance;
        $personne->cin = $request->ajcin;
        $personne->adressePersonnele = $request->ajadresse;
        $personne->tel = $request->ajtel;
        $personne->emailInstitutionne = $request->ajemailins;

        $personne->save();

        $idPersonne = DB::getPdo()->lastInsertId();

        $user = new User;
        $user->idPersonne = $idPersonne;
        $user->email = $request->ajemail;
        $user->role = 'admin';
        $RandPass = Str::random(10);
        $user->password = bcrypt($RandPass);
        $user->save();

        $profile = new Profile;
        $profile->idUtilisateur = DB::getPdo()->lastInsertId();
        $profile->croppedImage = '/vendors/images/user.svg';
        $profile->imagePath    = '/vendors/images/user.svg';
        $profile->save();

        $mailData = ['mailTo' => request('ajemail'), 'Username' => strval(request('ajnom') . ' ' . request('ajprenom')), 'email' => request('ajemail'), 'password' => $RandPass];
        SendAccountEmail::dispatch($mailData);
    }
}


