<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Matiere;
use phpDocumentor\Reflection\Types\This;
use DataTables;

class ProfesseurController extends Controller
{
    public function index()   //returns the page without the absence section (a non ajax request)
    {
        $matiers = $this->getMatiers();  //fill matiers drop down menue
        return view('prof.absences', ['MatiersList' => $matiers]);
    }
    
    public function getAbsences(Request $request)  //an ajax function to retrieve tha data
    {
        $absences = Absence::where('absence.idProf',1)  //first inint a user id
        ->join('matiere','absence.idMatier','=','matiere.idMatier') //retrieved matiere
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
        $matiers = Matiere::where('idProf',1)->select('nom as nomMatier')->get();
        return $matiers;
    }

    public function addRatt()
    {
        //all of String datatype
        $matier = request('matiere');
        $dataAbsence = request('dataAbsence');
        $dateRatt = request('dateRatt');
        $informerEtudiants = request('informerEtudiants');

        //parsing data
        if($matier == NULL)
        {
            return redirect('/absences');
        }
        else
        {
            $absence = Absence::create([
                'IdAbsence' => 7,
                'idProf' => 1,
                'idMatier' => 1,
                'dateAbsence' => $dataAbsence,
                'dateRattrapage' => str_replace('-',' ',$dateRatt),
                'etat' => 'en attendant',
            ]);
        }

        //send mails if informerEtudiants=on


    }
}
