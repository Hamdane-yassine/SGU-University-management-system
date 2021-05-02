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
       ->select('nom','prenom','apogee','cne','genre','dateNaissance','situationFamiliale','nationalite','lieuNaissance','cin','cinPere','cinMere','adressePersonnele','tel','email','emailInstitutionne','anneeDuBaccalaureat','regimeDeCovertureMedicale')
       ->get();
       if ($request->ajax()) {
            echo json_encode($etudiant);
        }
    }

    public function deleteEmploi($idEmploi)
    {
        echo $idEmploi;
        $emploi = Emploi::find($idEmploi);
        $emploi->delete();
        return redirect('/chef/emploi');
    }

}
