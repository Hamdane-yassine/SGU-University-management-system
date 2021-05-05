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
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Module;
use App\Models\Personne;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChefDepartementController extends Controller
{
    public function index()
    {
        //return list of profs in this department
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        /*$profs = Professeur::where('prof_departement.idDepartement',$idDepartement)
        ->join('prof_departement','professeur.idProf','prof_departement.idProf')
        ->join('users','users.id','=','professeur.idUtilisateur')
        ->select('professeur.idProf','users.name as nom')->get();*/

        //return list of filiere in that departement
        $filieres = Filiere::where('idDepartement',$idDepartement)->select('idFiliere','nom','niveau')->get();
        return view('chef.emploi',['filieres' => $filieres]);
    }


    public function getListOfFilieresEmploi(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $emplois = Filiere::where('idDepartement',$idDepartement)
        ->join('emploi','emploi.idEmploi','=','filiere.idEmploi')
        ->select('emploi.idEmploi as idEmploi','filename','filiere.nom as nom','niveau','emploi.created_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('filename', function($row)
            {
                $link_to_file = asset('storage/emploi/filiere/'.$row->filename);
                $btn = '<a class="text-success" href="' .$link_to_file. '" target="_blank" >' .$row->filename. '</a>';
                return $btn;
            })
            ->addColumn('action', function($row)
            {
                $btn = '<a href="emploi/delete/filiere/'.$row->idEmploi.'" class="edit btn btn-outline-danger btn-sm">Supprimer</a>';
                return $btn;
            })
            ->rawColumns(['action','filename'])
             ->make(true);
        }
    }

    public function Etudiants(Filiere $filiere)
    {
        return view('chef.Etudiant', ['filiere' => $filiere]);
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


   public function deleteEmploiProf($idEmploi)
    {
        echo $idEmploi;
        $emploi = Emploi::find($idEmploi);
        $filename = $emploi->fileName;
        Storage::delete('emploi/prof/'.$filename);  //delete the physical file
        $emploi->delete();
        return redirect('/chef/emploi');
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
    public function deleteEmploi($idEmploi)
    {
        echo $idEmploi;
        $emploi = Emploi::find($idEmploi);
        $filename = $emploi->fileName;
        Storage::delete('emploi/prof/'.$filename);  //delete the physical file
        $emploi->delete();
        return redirect('/chef/emploi');
    }

    public function deleteEmploiFiliere($idEmploi)
    {
        echo $idEmploi;
        $emploi = Emploi::find($idEmploi);
        $filename = $emploi->fileName;
        Storage::delete('emploi/filiere/'.$filename);  //delete the physical file
        $emploi->delete();
        return redirect('/chef/emploi');
    }

    public function uploadEmploi(Request $request)
    {
        $idFiliere =  $request->filiere;
        $file = $request->uploadedFile;
        $filiere = Filiere::where('idFiliere',$idFiliere)->select('idFiliere','nom as name','niveau','idEmploi')->get()[0];

        //echo $idFiliere.'<br>';
        //echo $filiere->nom;

        //add or update entry in emploi and filiere table
        if(is_null($filiere->idEmploi)) //then creat a new entry
        {
            $emploi = Emploi::create([
                'fileName' => $filiere->name.$filiere->niveau.'.pdf',
                'created_at' => '',
            ]);
            $file->storeAs('emploi/filiere/', $filiere->name.$filiere->niveau.'.pdf');  //store with the original name
            $emploi = Emploi::where('fileName',$filiere->name.$filiere->niveau.'.pdf')->select('idEmploi')->get()[0];
            $filiere = Filiere::find($idFiliere);
            $filiere->idEmploi = $emploi->idEmploi;
            $filiere->save();
        }
        else //meaning the filiere has already an emploi
        {
            //delete old file
            Storage::delete('emploi/filiere/', $filiere->name.$filiere->niveau.'.pdf');
            //delete the old entry
            $oldEmploi = Emploi::find($filiere->idEmploi);
            $oldEmploi->delete();
            //add new one
            $emploi = Emploi::create([
                'fileName' => $filiere->name.$filiere->niveau.'.pdf',
                'created_at' => '',
            ]);
            $file->storeAs('emploi/filiere/', $filiere->name.$filiere->niveau.'.pdf');  //store with the original name
            $emploi = Emploi::where('fileName',$filiere->name.$filiere->niveau.'.pdf')->select('idEmploi')->get()[0];
            $filiere = Filiere::find($idFiliere);
            $filiere->idEmploi = $emploi->idEmploi;
            $filiere->save();
        }
        return redirect('/chef/emploi'); //just in case
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

    public function Matieres(Filiere $filiere)
    {
        return view('chef.matieres', ['filiere' => $filiere]);
    }

    public function getNotes(Matiere $matiere)
    {
        return view('chef.Notes', ['matiere' => $matiere]);
    }

    public function getListNotes(Request $request,Matiere $matiere)  //an ajax function to retrieve tha data
    {

       $notes = Matiere::where('matiere.idMatiere',$matiere->idMatiere)  //first inint a user id
       ->join('module','module.idModule','=','matiere.idModule')
       ->join('filiere','module.idFiliere','=','filiere.idFiliere')
       ->join('etudiant','etudiant.idFiliere','=','filiere.idFiliere')
       ->join('personne','etudiant.idPersonne','=','personne.idPersonne')
       ->leftJoin('note', 'etudiant.idEtudiant', '=', 'note.idEtudiant')
       ->select('apogee','personne.nom','personne.prenom','cne','controle','exam','noteGeneral')
       ->get();
       if ($request->ajax()) {
            return Datatables::of($notes)
            ->make(true);
        }
    }
    public function Professeurs(Departement $departement)
    {
        return view('chef.profs', ['departement' => $departement]);
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
       ->select('professeur.idProf','personne.nom','personne.prenom','professeur.specialite','email','tel','dateNaissance','nationalite','lieuNaissance','situationFamiliale','genre','cin','adressePersonnele','emailInstitutionne')
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

    public function getMatiere(Professeur $professeur,Departement $departement) //get Matiere based on idFiliere
    {
        $MatieresList = array();
        foreach($professeur->matieres as $matiere)
        {
            if($matiere->module->filiere->departement->idDepartement == $departement->idDepartement)
            {
                array_push($MatieresList,$matiere);
            }
        }
        echo json_encode($MatieresList);
    }

    public function AffecterMatiere()
    {
        $idProf = request('prof');
        $idMatiere = request('matiereafect');
        $idDepartement = request('depA');
        $matiere = Matiere::find($idMatiere);
        $matiere->idProf=$idProf;
        $matiere->save();
        $professeur = Professeur::find($idProf);
        $MatieresList = array();
        $departement = Departement::find($idDepartement);
        foreach($professeur->matieres as $mat)
        {
            if($mat->module->filiere->departement->idDepartement == $departement->idDepartement)
            {
                array_push($MatieresList,$mat);
            }
        }
        return json_encode($MatieresList);
    }
    public function DetacherMatiere()
    {
        $idMatiere = request('matiere');
        $idProf = request('profdet');
        $idDepartement = request('depD');
        $matiere = Matiere::find($idMatiere);
        $matiere->idProf=null;
        $matiere->save();
        $professeur = Professeur::find($idProf);
        $MatieresList = array();
        $departement = Departement::find($idDepartement);
        foreach($professeur->matieres as $mat)
        {
            if($mat->module->filiere->departement->idDepartement == $departement->idDepartement)
            {
                array_push($MatieresList,$mat);
            }
        }
        return json_encode($MatieresList);
    }
    public function AbsencesIndex() //load abseces and return view for /chef/absence
    {
        return view('chef.absences');
    }

    public function getAbsencesForChef(Request $request)
    {
        //get the departement id of the current chef
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $profs = Professeur::where(['idDepartement'=> $idDepartement],['filiere.idDepartement' => $idDepartement])
        ->join('prof_departement','professeur.idProf','prof_departement.idProf')
        ->select('professeur.idProf')->get()->toArray();
        $absences = Absence::whereIn('absence.idProf',$profs)
        ->join('professeur','absence.idProf','=','professeur.idProf')
        ->join('users','users.id','=','professeur.idUtilisateur')
        ->join('matiere','matiere.idMatiere','=','absence.idMatiere')
        ->join('module','module.idModule','matiere.idModule')
        ->join('filiere','filiere.idFiliere','module.idFiliere')
        ->select('Absence.idAbsence','matiere.nom as nomMatiere','filiere.nom as nomFiliere','users.name as nomProf','Absence.dateAbsence as dateAbsence','Absence.etat')
        ->get();

        if ($request->ajax()) {
            return Datatables::of($absences)
            ->editColumn('dateAbsence', function ($request) {
                return $request->dateAbsence->toDayDateTimeString();
            })
            ->addColumn('etat', function($row)
            {
                $btn = ' ';
                if($row->etat == 'rattrapée')
                {
                    $btn = '<span style="background-color: #33cc33;" class="badge badge-pill">Rattrapé</span>';
                }
                else
                {
                    $btn = '<span style="background-color: #ff4d4d;" class="badge badge-pill">En attend</span>';
                }
                return $btn;
            })
            ->rawColumns(['etat'])
            ->make(true);
        }
    }

    public function getChefDashboard()
    {
        $annee = date("Y")."/".(date("Y")-1);
        $date = date("j/n/Y");
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        //get the count of students in the same departement
        $Count_etudiants = Filiere::where('idDepartement',$idDepartement)
        ->join('etudiant','etudiant.idFiliere','=','filiere.idFiliere')
        ->count();

        //filieres count
        $Count_filieres = Filiere::where('idDepartement',$idDepartement)->count();

        //get absences count (of profs within the same dep)
        $profs = Professeur::where('idDepartement',$idDepartement)->select('idProf')->get()->toArray()   ;
        $Count_absences = Absence::whereIn('idProf',$profs)->count();

        $etat_notes = Departement::find($idDepartement)->insertion_notes;

        //echo $annee.'<br>'.$date.'<br>'.$Count_etudiants.'<br>'.$Count_filieres.'<br>'.$Count_absences.'<br>'.$etat_notes;

        return view('chef.TableBoard',['annee' => $annee,'date' => $date,'Count_etudiants' => $Count_etudiants ,
          'Count_filieres' => $Count_filieres , 'Count_absences' => $Count_absences, 'etat_notes' => $etat_notes]);
    }

    public function getAbsencesListForChefDashboard(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $profs = Professeur::where('idDepartement',$idDepartement)->select('idProf')->get()->toArray();
        $absences = Absence::whereIn('absence.idProf',$profs)
        ->join('professeur','absence.idProf','=','professeur.idProf')
        ->join('users','users.id','=','professeur.idUtilisateur')
        ->select('Absence.idAbsence as idAbsence','users.name as nomProf','Absence.dateAbsence as dateAbsence')
        ->get();

        if ($request->ajax()) {
            return Datatables::of($absences)
            ->editColumn('dateAbsence', function ($request) {
                return $request->dateAbsence->toDayDateTimeString();
            })
            ->make(true);
        }
    }
}
