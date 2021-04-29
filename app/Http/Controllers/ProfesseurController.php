<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Matiere;
use phpDocumentor\Reflection\Types\This;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ProfesseurController extends Controller
{
    public function index()   //returns the page without the absence section (a non ajax request)
    {
        $matiers = $this->getMatiers();  //fill matiers drop down menue
        return view('prof.absences', ['MatiersList' => $matiers]);
    }

    public function getAbsences(Request $request)  //an ajax function to retrieve tha data
    {
        $absences = Absence::where('absence.idProf',Auth::id())  //first inint a user id
        ->join('matiere','absence.idMatiere','=','matiere.idMatiere') //retrieved matiere
        ->join('semestre','matiere.idModule','=','semestre.idModule')
        ->join('filiere','semestre.idFiliere','=','filiere.idFiliere')
        ->select('IdAbsence','matiere.nom as nomMatiere','filiere.nom as nomFiliere','dateAbsence','etat')
        ->get(); //altough this object is a Collection , we can still iterate overit using loops
        //return $absences;
         if ($request->ajax()) {
            return Datatables::of($absences)
            ->editColumn('dateAbsence', function ($request) {
                return $request->dateAbsence->toDayDateTimeString();
            })
            ->make(true);
        }
    }

    public function getMatiers()
    {
        $matiers = Matiere::where('idProf',Auth::id())->select('idMatiere as id','nom as nomMatier')->get();
        return $matiers;
    }

    public function addRatt()
    {
        //all of String datatype
        $idMatiere = request('matiere');
        $dateAbsence = request('dateAbsence');
        $dateRatt = request('dateRatt');
        $informerEtudiants = request('informerEtudiants');

        //parsing data
        if($idMatiere == NULL)
        {
            return redirect('/absences');
        }
        else
        {
            $absence = Absence::create([
                'idProf' => Auth::id(),
                'idMatiere' => $idMatiere,
                'dateAbsence' => $dateAbsence,
                'dateRattrapage' => str_replace('-',' ',$dateRatt),
                'etat' => 'en attendant',
            ]);
        }

        //send mails if informerEtudiants=on


    }
}
