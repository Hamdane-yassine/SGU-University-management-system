<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Filiere;
use App\Models\Professeur;
use Illuminate\Support\Facades\Auth;
use DataTables;

use Illuminate\Http\Request;

class ChefDepartementController extends Controller
{
    public function index()
    {
        return view('Chef.emploi');
    }

    public function getListOfProfEmploi(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $emplois = Professeur::where('idDepartement',$idDepartement)
        ->join('users','users.id','=','professeur.idUtilisateur')
        ->join('emploi','emploi.idEmploi','=','professeur.idEmploi')
        ->select('emploi.idEmploi','filename','users.name as nom','emploi.created_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)->make(true);
        }
    }

    public function getListOfFilieresEmploi(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $emplois = Filiere::where('idDepartement',$idDepartement)
        ->join('emploi','emploi.idEmploi','=','filiere.idEmploi')
        ->select('emploi.idEmploi','filename','filiere.nom as nom','emploi.created_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)->make(true);
        }
    }
}
