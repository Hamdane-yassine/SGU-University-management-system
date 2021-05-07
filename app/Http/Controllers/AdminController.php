<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use DataTables;

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
class AdminController extends Controller
{
    public function index()
    {
        $profs = Professeur::join('users','users.id','=','professeur.idUtilisateur')
        ->select('idProf','users.name as nom')->get();

        return view('admin.emploi',['profs' => $profs]);
    }

    public function getListOfProfEmploi(Request $request)
    {
        $emplois = Professeur::join('users','users.id','=','professeur.idUtilisateur')
        ->join('emploi','emploi.idEmploi','=','professeur.idEmploi')
        ->select('emploi.idEmploi as idEmploi','filename','users.name as nom','emploi.updated_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('filename', function($row)
            {
                $link_to_file = asset('storage/emploi/prof/'.$row->filename);
                $btn = '<a class="card-link text-primary" href="' .$link_to_file. '" target="_blank" >' .$row->filename. '</a>';
                return $btn;
            })
            ->addColumn('date', function($row)
            {
                setlocale(LC_TIME, "fr_FR", "French");
                return strftime("%A %d %B %G %R", strtotime($row->date));
            })
            ->rawColumns(['filename','date'])
            ->make(true);
        }
    }

    public function uploadEmploi(Request $request)
    {
        $idProf =  $request->prof;
        $file = $request->uploadedFile;

        $prof = Professeur::where('idProf',$idProf)
        ->join('users','professeur.idUtilisateur','=','users.id')
        ->select('users.id','users.name as name','idEmploi','idProf')
        ->get()[0];

        //echo $idProf.'<br>';
        //echo $prof->name;

        //add or update entry in emploi and professeur table
        if(is_null($prof->idEmploi)) //then creat a new entry
        {
            $emploi = Emploi::create([
                'fileName' => $prof->name.'.pdf',
                'created_at' => '',
            ]);

            $file->storeAs('emploi/prof/', $prof->name.'.pdf');  //store with the original name

            $emploi = Emploi::where('fileName',$prof->name.'.pdf')->select('idEmploi')->get()[0];
            $prof = Professeur::find($idProf);
            $prof->idEmploi = $emploi->idEmploi;
            $prof->save();
        }
        else //meaning the prof has already an emploi
        {
            //delete old file
            Storage::delete('emploi/prof/', $prof->name.'.pdf');
            //delete the old entry
            $oldEmploi = Emploi::find($prof->idEmploi);
            $oldEmploi->delete();

            //add new one
            $emploi = Emploi::create([
                'fileName' => $prof->name.'.pdf',
                'created_at' => '',
            ]);

            $file->storeAs('emploi/prof/', $prof->name.'.pdf');  //store with the original name

            $emploi = Emploi::where('fileName',$prof->name.'.pdf')->select('idEmploi')->get()[0];
            $prof = Professeur::find($idProf);
            $prof->idEmploi = $emploi->idEmploi;
            $prof->save();
        }
        return redirect('admin/emploi'); //just in case*/
    }

    public function deleteEmploiProf()
    {
        $idEmploi = request('idEmploi');
        $emploi = Emploi::find($idEmploi);
        $filename = $emploi->fileName;
        Storage::delete('emploi/prof/'.$filename);  //delete the physical file
        $emploi->delete();
    }

    public function getFilieres(Departement $departement)
    {
        return view('admin.filieres',['departement' => $departement]);
    }
    
    public function Etudiants(Filiere $filiere)
    {
        return view('admin.Etudiant', ['filiere' => $filiere]);
    }

    public function getEtudiants(Request $request,Filiere $filiere)  //an ajax function to retrieve tha data
    {

       $etudiants = Etudiant::where('etudiant.idFiliere',$filiere->idFiliere)  //first inint a user id
       ->join('personne','etudiant.idPersonne','=','personne.idPersonne') //retrieved matiere
       ->select('apogee','nom','prenom','cne','email','tel','idEtudiant')
       ->get();
       if ($request->ajax()) {
            return Datatables::of($etudiants)
            ->make(true);
        }
    }

    public function getEtudiant(Request $request,Etudiant $etudiant)  //an ajax function to retrieve tha data
    {

       $etudiant = Etudiant::where('idEtudiant',$etudiant->idEtudiant)  //first inint a user id
       ->join('personne','etudiant.idPersonne','=','personne.idPersonne') //retrieved matiere
       ->select('nom','prenom','apogee','cne','genre','dateNaissance','situationFamiliale','nationalite','lieuNaissance','cin','cinPere','cinMere','adressePersonnele','tel','email','emailInstitutionne','anneeDuBaccalaureat','regimeDeCovertureMedicale','etudiant.idEtudiant')
       ->get();
       if ($request->ajax()) {
            echo json_encode($etudiant);
        }
    }
    
    public function SupprimerEtudiant()
    {
        $idEtudiant = request('idEtudiant');
        $etudiant = Etudiant::find($idEtudiant);
        $idPersonne = $etudiant->idPersonne;
        $personne = Personne::find($idPersonne);
        $etudiant->delete();
        $personne->delete();
    }

    public function UpdateEtudiant()
    {
        request()->validate([
            'inIdEtudiant' => 'required',
            'innom' => 'required',
            'inprenom' => 'required',
            'insituation' => 'required',
            'ingenre' => 'required',
            'indatenais' => ['required','date'],
            'innationalite' => 'required',
            'inLieuNaissance' => 'required',
            'inadresse' => 'required',
            'incin' => 'required',
            'intel' => 'required',
            'inemail' => ['required','email'],
            'inemailins' => ['required','email'],
            'inapogee' => 'required',
            'incne' => 'required',
            'incinpere' => 'required',
            'incinmere' => 'required',
            'inannebac' => 'required',
            'incouv' => 'required'
        ]);
        $idEtudiant=request('inIdEtudiant');
        $etudiant = Etudiant::find($idEtudiant);
        $idPersonne = $etudiant->idPersonne;
        $personne = Personne::find($idPersonne);
        $personne->nom=request('innom');
        $personne->prenom=request('inprenom');
        $personne->situationFamiliale=request('insituation');
        $personne->genre=request('ingenre');
        $personne->dateNaissance=request('indatenais');
        $personne->nationalite=request('innationalite');
        $personne->lieuNaissance=request('inLieuNaissance');
        $personne->adressePersonnele=request('inadresse');
        $personne->cin=request('incin');
        $personne->tel=request('intel');
        $personne->emailInstitutionne=request('inemailins');
        $etudiant->apogee=request('inapogee');
        $etudiant->cne=request('incne');
        $etudiant->email=request('inemail');
        $etudiant->cinPere=request('incinpere');
        $etudiant->cinMere=request('incinmere');
        $etudiant->anneeDuBaccalaureat=request('inannebac');
        $etudiant->regimeDeCovertureMedicale=request('incouv');
        $personne->save();
        $etudiant->save();
    }

    public function AjouterEtudiant()
    {
        request()->validate([
            'idFiliere' => 'required',
            'ajnom' => 'required',
            'ajprenom' => 'required',
            'ajsituation' => 'required',
            'ajgenre' => 'required',
            'ajdatenais' => ['required','date'],
            'ajnationalite' => 'required',
            'ajLieuNaissance' => 'required',
            'ajadresse' => 'required',
            'ajcin' => 'required',
            'ajtel' => 'required',
            'ajemail' => ['required','email'],
            'ajemailins' => ['required','email'],
            'ajapogee' => 'required',
            'ajcne' => 'required',
            'ajcinpere' => 'required',
            'ajcinmere' => 'required',
            'ajannebac' => 'required',
            'ajcouv' => 'required'
        ]);
        $idFiliere=request('idFiliere');
        $etudiant = new Etudiant;
        $personne = new Personne;
        $personne->nom=request('ajnom');
        $personne->prenom=request('ajprenom');
        $personne->situationFamiliale=request('ajsituation');
        $personne->genre=request('ajgenre');
        $personne->dateNaissance=request('ajdatenais');
        $personne->nationalite=request('ajnationalite');
        $personne->lieuNaissance=request('ajLieuNaissance');
        $personne->adressePersonnele=request('ajadresse');
        $personne->cin=request('ajcin');
        $personne->tel=request('ajtel');
        $personne->emailInstitutionne=request('ajemailins');
        $personne->save();
        $Personne = Personne::where('emailInstitutionne',request('ajemailins'))->where('cin',request('ajcin'))->select('idPersonne')->get()[0];
        $etudiant->apogee=request('ajapogee');
        $etudiant->cne=request('ajcne');
        $etudiant->email=request('ajemail');
        $etudiant->cinPere=request('ajcinpere');
        $etudiant->cinMere=request('ajcinmere');
        $etudiant->anneeDuBaccalaureat=request('ajannebac');
        $etudiant->regimeDeCovertureMedicale=request('ajcouv');
        $etudiant->idFiliere=$idFiliere;
        $etudiant->idPersonne=$Personne->idPersonne;
        $etudiant->save();
    }
    public function FetchDashboardData()
    {
        $annee = date("Y")."/".(date("Y")-1);
        $date = date("j/n/Y");

        //totla etudiants count
        $CountEtudiant = Etudiant::all()->count();

        //total nbre dep
        $CountDepartement = Departement::all()->count();

        //totla nbre des filieres
        $CountFiliere = Filiere::all()->count();

        //total nbre of profs without emploi
        $CountProf = Professeur::whereNull('idEmploi')->count();

        return view('admin.TableBoard',['annee' => $annee , 'date' => $date , 'CountEtudiant' => $CountEtudiant ,
        'CountDepartement' => $CountDepartement ,'CountFiliere' => $CountFiliere , 'CountProf' => $CountProf]);
    }

    public function adminDashboardTable(Request $request)
    {
        $profs = Professeur::whereNull('idEmploi')
        ->join('users','professeur.idUtilisateur','users.id')
        ->select('idProf','users.name as nomProf','specialite')
        ->get();

        if ($request->ajax()) {
            return Datatables::of($profs)
            ->make(true);
        }
    }

    public function indexEmploiFiliere()
    {
        return view('admin.emploiFiliere');
    }

    public function getAdminEmploiFiliereDatatable(Request $request)
    {
        $emplois = Filiere::join('emploi','emploi.idEmploi','filiere.idEmploi')
        ->select('emploi.idEmploi as idEmploi','filename','filiere.nom as nom','niveau','emploi.updated_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('filename', function($row)
            {
                $link_to_file = asset('storage/emploi/filiere/'.$row->filename);
                $btn = '<a href="' .$link_to_file. '"  target="_blank" class="card-link text-primary" >' .$row->filename. '</a>';
                return $btn;
            })
            ->addColumn('date', function($row)
            {
                setlocale(LC_TIME, "fr_FR", "French");
                return strftime("%A %d %B %G %R", strtotime($row->date));
            })
            ->rawColumns(['filename','date'])
            ->make(true);
        }
    }

    public function Professeurs(Departement $departement)
    {
        return view('admin.profs', ['departement' => $departement]);
    }

    public function getProfesseurs(Request $request , Departement $departement)
    {
        $professeurs = Departement::where('departement.idDepartement',$departement->idDepartement)  //first inint a user id
       ->join('prof_departement','departement.idDepartement','=','prof_departement.idDepartement')
       ->join('professeur','prof_departement.idProf','=','professeur.idProf')
       ->join('users','professeur.idUtilisateur','=','users.id')
       ->join('personne','users.idPersonne','=','personne.idPersonne')
       ->select('professeur.idProf','personne.nom','personne.prenom','professeur.specialite','email','tel',)
       ->get();
       if ($request->ajax()) {
            return Datatables::of($professeurs)
            ->make(true);
        }
    }

    public function getProfesseur(Request $request,Professeur $professeur)
    {
        $professeurs = Professeur::where('professeur.idProf',$professeur->idProf)  //first inint a user id
       ->join('users','professeur.idUtilisateur','=','users.id')
       ->join('personne','users.idPersonne','=','personne.idPersonne')
       ->select('professeur.idProf','personne.nom','personne.prenom','role','professeur.specialite','email','tel','dateNaissance','nationalite','lieuNaissance','situationFamiliale','genre','cin','adressePersonnele','emailInstitutionne')
       ->get();

        $matieres = Matiere::where('idProf',$professeur->idProf)
        ->select('nom')->get();

        $data = array();
        $data['prof'] = $professeurs;
        $data['matieres'] = $matieres;

        if ($request->ajax()) {
            echo json_encode($data);
        }
    }

    public function SupprimerProfesseur()
    {
        $idProf = request('idProf');
        $professeur = Professeur::find($idProf);
        $iduser =$professeur->idUtilisateur;
        $user = User::find($iduser);
        $idPersonne = $user->idPersonne;
        $personne = Personne::find($idPersonne);
        $idEmploi = $professeur->idEmploi;
        $emploi = Emploi::find($idEmploi);
        DB::table('chefdep')->where('idProf', '=', $idProf)->delete();
        DB::table('prof_departement')->where('idProf', '=', $idProf)->delete();
        DB::table('profiles')->where('idUtilisateur', '=', $user->id)->delete();
        $professeur->delete();
        $user->delete();
        $personne->delete();
        if($emploi != null)
        {
            $filename = $emploi->fileName;
            Storage::delete('emploi/prof/'.$filename);
            $emploi->delete();
        }
    }

    public function UpdateProfesseur()
    {
        request()->validate([
            'inidProf' => 'required',
            'innom' => 'required',
            'inprenom' => 'required',
            'insituation' => 'required',
            'ingenre' => 'required',
            'indatenais' => ['required','date'],
            'innationalite' => 'required',
            'inLieuNaissance' => 'required',
            'inadresse' => 'required',
            'incin' => 'required',
            'intel' => 'required',
            'inemail' => ['required','email'],
            'inemailins' => ['required','email'],
            'inspecialite' => 'required',
            'role' => 'required'
        ]);
        $idDep = request('idDepup');
        $idProf=request('inidProf');
        $professeur = Professeur::find($idProf);
        $idUser = $professeur->idUtilisateur;
        $user = User::find($idUser);
        $idPersonne = $user->idPersonne;
        $personne = Personne::find($idPersonne);
        $personne->nom=request('innom');
        $personne->prenom=request('inprenom');
        $personne->situationFamiliale=request('insituation');
        $personne->genre=request('ingenre');
        $personne->dateNaissance=request('indatenais');
        $personne->nationalite=request('innationalite');
        $personne->lieuNaissance=request('inLieuNaissance');
        $personne->adressePersonnele=request('inadresse');
        $personne->cin=request('incin');
        $personne->tel=request('intel');
        $personne->emailInstitutionne=request('inemailins');
        $professeur->specialite=request('inspecialite');
        if(request('role')==1 && $user->role=="chefdep")
        {
            DB::table('chefdep')->where('idProf', '=', $idProf)->delete();
            $user->role="prof";
        }
        elseif(request('role')==2 && $user->role=="prof")
        {
            $oldchefdata = Chefdep::where('idDepartement',$idDep)->select('idProf')->get();
            if($oldchefdata->isEmpty())
            {
                $dep = new Chefdep;
                $dep->idDepartement=$idDep;
                $dep->idProf=$idProf;
                $dep->save();
            }else{
                DB::table('chefdep')->where('idDepartement', '=', $idDep)->delete();
                $idProf=$oldchefdata[0]->idProf;
                $oldchef = Professeur::find($idProf);
                $idUser=$oldchef->idUtilisateur;
                $oldchefuser = User::find($idUser);
                $oldchefuser->role="prof";
                $oldchefuser->save();
                $dep = new Chefdep;
                $dep->idDepartement=$idDep;
                $dep->idProf=$idProf;
                $dep->save();
            }    
            $user->role="chefdep";
        }
        $personne->save();
        $user->save();
        $professeur->save();
    }
    
    public function AjouterProfesseur()
    {
        request()->validate([
            'idDepart' => 'required',
            'ajnom' => 'required',
            'ajprenom' => 'required',
            'ajsituation' => 'required',
            'ajgenre' => 'required',
            'ajdatenais' => ['required','date'],
            'ajnationalite' => 'required',
            'ajLieuNaissance' => 'required',
            'ajadresse' => 'required',
            'ajcin' => 'required',
            'ajtel' => 'required',
            'ajemail' => ['required','email'],
            'ajemailins' => ['required','email'],
            'ajspecialite' => 'required',
            'ajrole' => 'required'
        ]);
        $idDepart=request('idDepart');
        $personne = new Personne;
        $personne->nom=request('ajnom');
        $personne->prenom=request('ajprenom');
        $personne->situationFamiliale=request('ajsituation');
        $personne->genre=request('ajgenre');
        $personne->dateNaissance=request('ajdatenais');
        $personne->nationalite=request('ajnationalite');
        $personne->lieuNaissance=request('ajLieuNaissance');
        $personne->adressePersonnele=request('ajadresse');
        $personne->cin=request('ajcin');
        $personne->tel=request('ajtel');
        $personne->emailInstitutionne=request('ajemailins');
        $personne->save();
        //user 
        $user = new User;
        $user->email=request('ajemail');
        $Personne = Personne::where('emailInstitutionne',request('ajemailins'))->where('cin',request('ajcin'))->select('idPersonne')->get()[0];
        $user->idPersonne=$Personne->idPersonne;
        if(request('ajrole')==2)$user->role="chefdep";
        elseif(request('ajrole')==1)$user->role="prof";
        $user->password=bcrypt('1');
        $user->save();
        //
        $User = User::where('email',request('ajemail'))->select('id')->get()[0];
        $professeur = new Professeur;
        $professeur->idUtilisateur=$User->id;
        $professeur->specialite=request('ajspecialite');
        $professeur->save();
        $Professeur = Professeur::where('idUtilisateur',$User->id)->select('idProf')->get()[0];
        $prof_departement = new Prof_departement;
        $prof_departement->idProf=$Professeur->idProf;
        $prof_departement->idDepartement=$idDepart;
        $prof_departement->save();
        if(request('ajrole')==2)
        {
            $oldchefdata = Chefdep::where('idDepartement',$idDepart)->select('idProf')->get();
            if($oldchefdata->isEmpty())
            {
                $dep = new Chefdep;
                $dep->idDepartement=$idDepart;
                $dep->idProf=$Professeur->idProf;
                $dep->save();
            }else{
                DB::table('chefdep')->where('idDepartement', '=', $idDepart)->delete();
                $idProf=$oldchefdata[0]->idProf;
                $oldchef = Professeur::find($idProf);
                $idUser=$oldchef->idUtilisateur;
                $oldchefuser = User::find($idUser);
                $oldchefuser->role="prof";
                $oldchefuser->save();
                $dep = new Chefdep;
                $dep->idDepartement=$idDepart;
                $dep->idProf=$Professeur->idProf;
                $dep->save();
            }    
        }
    }


}
