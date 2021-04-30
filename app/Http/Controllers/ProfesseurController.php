<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Module;
use App\Models\Professeur;
use phpDocumentor\Reflection\Types\This;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ProfesseurController extends Controller
{
    public function index()   //returns the page without the absence section (a non ajax request)
    {

        $filieres=array();
        if(!empty(auth()->user()->professeur->matieres))
        {
            foreach (auth()->user()->professeur->matieres as $matiere)
            {
                array_push($filieres, $matiere->module->filiere);
            }
            $filieres = array_unique($filieres);
        }
        return view('prof.absences', ['filieresList' => $filieres]);
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

    public function getMatiere($idFiliere) //get Matiere based on idFiliere
    {
        $MatieresList = Filiere::where('filiere.idFiliere',$idFiliere)
        ->where('matiere.idProf',Auth::user()->professeur->idProf)
        ->join('module','filiere.idFiliere','=','module.idFiliere')
        ->join('matiere','module.idModule','=','matiere.idModule')
        ->select('matiere.idMatiere as idMatiere','matiere.nom as nomMatiere')->get();
        //echo $MatieresList;
        return json_encode($MatieresList);
    }

    public function addRatt()
    {
        //all of String datatype
        $idMatiere = request('matiere');
        $dateAbsence = request('dateAbsence');
        $dateRatt = request('dateRatt');
        $informerEtudiants = request('informerEtudiants');

        //echo Auth::user()->professeur->idProf.'<br>'.$idMatiere.'<br>'.$dateAbsence.'<br>'.$dateRatt.'<br>'.$informerEtudiants;

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
            return redirect('/absences');
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

    public function getEtudiant(Request $request,Etudiant $etudiant)  //an ajax function to retrieve tha data
    {

       $etudiant = Etudiant::where('idEtudiant',$etudiant->idEtudiant)  //first inint a user id
       ->join('personne','etudiant.idPersonne','=','personne.idPersonne') //retrieved matiere
       ->select('nom','prenom','apogee','cne','genre','dateNaissance','situationFamiliale','nationalite','lieuNaissance','cin','cinPere','cinMere','adressePersonnele','tel','email','emailInstitutionne','anneeDuBaccalaureat','regimeDeCovertureMedicale')
       ->get();
       if ($request->ajax()) {
            return Datatables::of($etudiant)
            ->make(true);
        }
    }
    public function FetchDashBoardData(Request $request)
    {
        //formatted as : {current year / past year}
        $annee = date("Y")."/".(date("Y")-1);
        return view('prof.TableBoard');

    }
}
