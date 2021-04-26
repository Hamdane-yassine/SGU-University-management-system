<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence; 

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
        return view('viewshtml.professeur.absences', ['absences' => $absences]);
        /*
        foreach (Flight::all() as $flight) {
            echo $flight->name;
        }
        */
    }
}
