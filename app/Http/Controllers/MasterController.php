<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Module;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Egulias\EmailValidator\Exception\UnclosedComment;

class MasterController extends Controller
{
    public function indexFilieres($idDepartement)
    {
        //get list of filieres in that departement
        $filieres = Filiere::where('idDepartement',$idDepartement)->get();

        //get list of semesters
        $Semestres = Semestre::where('filiere.idDepartement', $idDepartement)
            ->join('filiere','filiere.idFiliere','semestre.idFiliere')
            ->select('idSemestre as id','semestre.nom as name')->get();

        return view('master.filiere',['idDepartement' => $idDepartement, 'filieres' => $filieres, 'Semestres' => $Semestres ]);
    }

    public function getFilieresDatatable(Request $request,$idDepartement)
    {
        $filieres = Filiere::where('filiere.idDepartement',$idDepartement)
        ->leftJoin('etudiant','etudiant.idFiliere','filiere.idFiliere')
        ->groupBy('filiere.idFiliere')
        ->select('filiere.idFiliere as idFiliere','filiere.nom as nomFiliere','filiere.niveau as niveau',DB::raw('COUNT(*) as CountEtudiant'))->get();

        if($request->ajax()) {
            return Datatables::of($filieres)
            ->addColumn('action', function($row)
            {
                //$btn = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="initModal('.$row->idFiliere.')"><i class="fa fa-pencil"></button><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="initModal('.$row->idFiliere.')"><i class="fa fa-pencil"></button>';
                $btn = '<ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="modal" data-target="#exampleModal" onclick="initModal('.$row->idFiliere.')" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                            </li>
                            <li class="list-inline-item">
                                <a href="/master/filiere/delete/'.$row->idFiliere.'"><button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
                            </li>
                    </ul>';

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

    public function deleteFiliere(Request $request,$idFiliere)
    {
        Filiere::destroy($idFiliere);
        return redirect()->back();
    }


    public function getSemestresOfFiliere($idFiliere)
    {
        $Semestres = Semestre::where('idFiliere',$idFiliere)->select('idSemestre as id','nom as name')->get()->toArray();
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
        $Modules = Filiere::where('filiere.idFiliere',$semester->idFiliere)
        ->join('module','module.idFiliere','filiere.idFiliere')
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
}
