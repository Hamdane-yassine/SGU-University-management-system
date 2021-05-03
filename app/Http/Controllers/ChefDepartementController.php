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

class ChefDepartementController extends Controller
{
    public function index()
    {
        return view('chef.emploi');
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
            ->addColumn('action', function($row)
            {
                $btn = '<a href="emploi/delete/'.$row->idEmploi.'" class="edit btn btn-outline-danger btn-sm">Supprimer</i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
             ->make(true);
        }
    }

    public function getListOfFilieresEmploi(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $emplois = Filiere::where('idDepartement',$idDepartement)
        ->join('emploi','emploi.idEmploi','=','filiere.idEmploi')
        ->select('emploi.idEmploi as idEmploi','filename','filiere.nom as nom','emploi.created_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('action', function($row)
            {
                $btn = '<a href="emploi/delete/'.$row->idEmploi.'" class="edit btn btn-outline-danger btn-sm">Supprimer</a>';
                return $btn;
            })
            ->rawColumns(['action'])
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
        $emploi->delete();
        return redirect('/chef/emploi');
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
        $personne->email=request('inemail');
        $personne->emailInstitutionne=request('inemailins');
        $etudiant->apogee=request('inapogee');
        $etudiant->cne=request('incne');
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

}
