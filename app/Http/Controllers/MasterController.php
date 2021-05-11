<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class MasterController extends Controller
{
    public function indexFilieres($idDepartement)
    {
        //get list of filieres in that departement
        $filieres = Filiere::where('idDepartement',$idDepartement)->get();

        return view('master.filiere',['idDepartement' => $idDepartement, 'filieres' => $filieres]);
    }

    public function getFilieresDatatable(Request $request,$idDepartement)
    {
        $filieres = Filiere::where('filiere.idDepartement',$idDepartement)
        ->join('etudiant','etudiant.idFiliere','filiere.idFiliere')
        ->groupBy('filiere.idFiliere')
        ->select('filiere.idFiliere as idFiliere','filiere.nom as nomFiliere','filiere.niveau as niveau',DB::raw('COUNT(*) as CountEtudiant'))->get();

        if($request->ajax()) {
            return Datatables::of($filieres)
            ->addColumn('action', function($row)
            {
                $btn = '<a style="color: #265ed7" class="color-light-blue" data-toggle="modal" data-target="#exampleModal" onclick="initModal('.$row->idFiliere.')"><i class="icon-copy dw dw-edit2"></a>';

                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function updateFiliere(Request $request, $idDepartement)
    {
        echo 'idFiliere to update : '.$request->idFiliere.' nom: '.$request->nomFiliere.' niv : '.$request->niveau;

        if(is_null($request->idFiliere) || (is_null($request->niveau) && is_null($request->nomFiliere)) ) return view('master.filiere');

        $filiere = Filiere::find($request->idFiliere);
        if(!is_null($request->nomFiliere)) $filiere->nom = $request->nomFiliere;
        if(!is_null($request->niveau)) $filiere->niveau = $request->niveau;
        $filiere->save();

        return redirect('/master/filiere/'.$idDepartement);
    }
}
