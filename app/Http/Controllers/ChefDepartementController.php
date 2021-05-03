<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use DataTables;

use App\Models\Absence;
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
        $profs = Professeur::where('idDepartement',$idDepartement)
        ->join('users','users.id','=','professeur.idUtilisateur')
        ->select('idProf','users.name as nom')->get();

        //return list of filiere in that departement
        $filieres = Filiere::where('idDepartement',$idDepartement)->select('idFiliere','nom','niveau')->get();
        return view('chef.emploi',['profs' => $profs , 'filieres' => $filieres]);
    }

    public function getListOfProfEmploi(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $emplois = Professeur::where('idDepartement',$idDepartement)
        ->join('users','users.id','=','professeur.idUtilisateur')
        ->join('emploi','emploi.idEmploi','=','professeur.idEmploi')
        ->select('emploi.idEmploi as idEmploi','filename','users.name as nom','emploi.created_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('filename', function($row)
            {
                $link_to_file = asset('storage/emploi/prof/'.$row->filename);
                $btn = '<a class="text-success" href="' .$link_to_file. '" target="_blank" >' .$row->filename. '</a>';
                return $btn;
            })
            ->addColumn('action', function($row)
            {
                $btn = '<a href="emploi/delete/prof/'.$row->idEmploi.'" class="edit btn btn-outline-danger btn-sm">Supprimer</i></a>';
                return $btn;
            })
            ->rawColumns(['action','filename'])
            ->make(true);
        }
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
        $selection =  $request->ProfOrFiliere;
        $file = $request->uploadedFile;

        if($selection[0] == 'p') //means we're uploading emploi for a prof
        {
            //store the file
            $idProf = substr($selection,1);
            $prof = Professeur::where('idProf',$idProf)->join('users','professeur.idUtilisateur','=','users.id')
            ->select('users.id','users.name as name','idEmploi','idProf')
            ->get()[0];

            echo $idProf.'<br>';
            echo $prof->name;

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

        }
        elseif($selection[0] == 'f') //means we're uploading emploi for a filiere
        {
            $idFiliere = substr($selection,1);
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

    public function AbsencesIndex() //load abseces and return view for /chef/absence
    {
        return view('chef.absences');
    }

    public function getAbsencesForChef(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $profs = Professeur::where('idDepartement',$idDepartement)->select('idProf')->get()->toArray();
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

    // public function getProfesseurs(Request $request , Departement $departement)
    // {
    //     $professeurs = Matiere::where('matiere.idMatiere',$matiere->idMatiere)  //first inint a user id
    //    ->join('module','module.idModule','=','matiere.idModule')
    //    ->join('filiere','module.idFiliere','=','filiere.idFiliere')
    //    ->join('etudiant','etudiant.idFiliere','=','filiere.idFiliere')
    //    ->join('personne','etudiant.idPersonne','=','personne.idPersonne')
    //    ->leftJoin('note', 'etudiant.idEtudiant', '=', 'note.idEtudiant')
    //    ->select('apogee','personne.nom','personne.prenom','cne','controle','exam','noteGeneral')
    //    ->get();
    //    if ($request->ajax()) {
    //         return Datatables::of($professeurs)
    //         ->make(true);
    //     }
    // }
}
