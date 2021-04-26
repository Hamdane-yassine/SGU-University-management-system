<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Matiere;

class ProfesseurController extends Controller
{
    
    public function getAbsences()
    {
        $absences = Absence::where('absence.idProf',1)  //first inint a user id
        ->join('matiere','absence.idMatier','=','matiere.idMatier') //retrieved matiere
        ->join('semestre','matiere.idModule','=','semestre.idModule')
        ->join('filiere','semestre.idFiliere','=','filiere.idFiliere')
        ->select('IdAbsence','matiere.nom as nomMatiere','filiere.nom as nomFiliere','dateAbsencee','etat')
        ->get(); //altough this object is a Collection , we can still iterate overit using loops
        return $absences; 
        
    }

    public function getMatiers()
    {
        $matiers = Matiere::where('idMatier',1)->select('nom as nomMatier')->get(); 
        return $matiers; 
    }

    public function getAllData()
    {
        $absences = Absence::where('absence.idProf',1)  //first inint a user id
        ->join('matiere','absence.idMatier','=','matiere.idMatier') //retrieved matiere
        ->join('semestre','matiere.idModule','=','semestre.idModule')
        ->join('filiere','semestre.idFiliere','=','filiere.idFiliere')
        ->select('IdAbsence','matiere.nom as nomMatiere','filiere.nom as nomFiliere','dateAbsencee','etat')
        ->get(); //altough this object is a Collection , we can still iterate overit using loops

        $matiers = Matiere::where('idMatier',1)->select('nom as nomMatier')->get(); 


        return view('viewshtml.professeur.absences', ['absences' => $absences, 'MatiersList' => $matiers]);
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
                'dateAbsencee' => $dataAbsence,
                'dateRattrapage' => str_replace('-',' ',$dateRatt),
                'etat' => 0,
            ]);
        }

    }
}
