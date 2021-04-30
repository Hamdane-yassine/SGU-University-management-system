<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Professeur;
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
        $id_prof = Auth::user()->professeur->idProf;
        $absences = Absence::where('absence.idProf',$id_prof)  //first inint a user id
        ->join('matiere','absence.idMatiere','=','matiere.idMatiere') //retrieved matiere
        ->join('module','matiere.idModule','=','module.idModule')
        ->join('filiere','module.idFiliere','=','filiere.idFiliere')
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
        $id = Auth::user()->professeur->idProf; 
        $matiers = Matiere::where('idProf',$id)->select('idMatiere as id','nom as nomMatiere')->get();
        return $matiers;
    }

    public function addRatt()
    {
        //all of String datatype
        $idMatiere = request('matiere');
        $dateAbsence = request('dateAbsence');
        $dateRatt = request('dateRatt');
        $informerEtudiants = request('informerEtudiants');

        echo Auth::user()->professeur->idProf.'<br>'.$idMatiere.'<br>'.$dateAbsence.'<br>'.$dateRatt.'<br>'.$informerEtudiants; 
       
        $id = Auth::user()->professeur->idProf; 
        //parsing data
        if($idMatiere == NULL)
        {
            return redirect('/absences');
        }
        else
        {
            $absence = Absence::create([
                'idProf' => $id,
                'idMatiere' => $idMatiere,
                'dateAbsence' => $dateAbsence,
                'dateRattrapage' => str_replace('-',' ',$dateRatt),
                'etat' => 'en attendant',
            ]);
        }
      

        //send mails if informerEtudiants=on

    }
    
    public function Etudiants(Filiere $filiere)
    {
        return view('prof.Etudiant', ['filiere' => $filiere]);
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
}
