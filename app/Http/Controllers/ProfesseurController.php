<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\Emploi;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Module;
use App\Models\Professeur;
use phpDocumentor\Reflection\Types\This;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        ->select('IdAbsence','matiere.nom as nomMatiere',DB::raw("concat_ws(filiere.nom,' ', filiere.niveau) AS nomFiliere"),'dateAbsence','etat')
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
            echo json_encode($etudiant);
        }
    }
    public function FetchDashBoardData(Request $request)
    {
        //formatted as : {current year / past year}
        $annee = date("Y")."/".(date("Y")-1);
        $date = date("j/n/Y");
        //get all students of the curent prof
        $filieres=array();
        if(!empty(auth()->user()->professeur->matieres))
        {
            foreach (auth()->user()->professeur->matieres as $matiere)
            {
                array_push($filieres, $matiere->module->filiere);
            }
            $filieres = array_unique($filieres);
        }
        $idFilieres = array_column($filieres, 'idFiliere');
        $etudiants = Etudiant::whereIn('etudiant.idFiliere',$idFilieres)  //first inint a user id
        ->join('personne','etudiant.idPersonne','=','personne.idPersonne') //retrieved matiere
        ->select('idEtudiant')
        ->get();

        $EtudiantCount = count($etudiants);
        $FiliereCount = count($filieres);
        $AbsenceCount = Absence::where('idProf',Auth::user()->professeur->idProf)->count();
        $MatiereCount = count(auth()->user()->professeur->matieres);
        $insertionNotes = auth()->user()->professeur->departement->insertion_notes;

        //echo auth()->user()->professeur->departement->idDepartement." ".$EtudiantCount." ".$FiliereCount." ".$AbsenceCount." ".$MatiereCount;
        return view('prof.TableBoard',['annee' => $annee,'date' => $date ,
        'EtudiantCount' => $EtudiantCount , 'FiliereCount' => $FiliereCount ,
        'AbsenceCount' => $AbsenceCount , 'MatiereCount' => $MatiereCount, 'insertionNotes' => $insertionNotes]);
    }

    public function getNotes(Matiere $matiere)
    {
        return view('prof.Notes', ['matiere' => $matiere]);
    }

    public function getListNotes(Request $request,Matiere $matiere)  //an ajax function to retrieve tha data
    {

       $notes = Matiere::where('matiere.idMatiere',$matiere->idMatiere)  //first inint a user id
       ->join('module','module.idModule','=','matiere.idModule')
       ->join('filiere','module.idFiliere','=','filiere.idFiliere')
       ->join('etudiant','etudiant.idFiliere','=','filiere.idFiliere')
       ->join('personne','etudiant.idPersonne','=','personne.idPersonne')
       ->leftJoin('note', 'etudiant.idEtudiant', '=', 'note.idEtudiant')
       ->select('apogee','personne.nom','personne.prenom','cne','controle','exam','noteGeneral','idNote','etudiant.idEtudiant')
       ->get();
       if ($request->ajax()) {
            return Datatables::of($notes)
            ->make(true);
        }
    }

    public function getMyEmploi()
    {
        $idEmploi = auth()->user()->professeur->idEmploi;
        if(is_null($idEmploi))
        {
            return view('prof.emploi',['path_to_file' => 'notFound', 'Mine' => 'true']);
        }
        $emploi = Emploi::find($idEmploi);
        $file_name = $emploi->fileName;
        $path_to_file = asset('storage/emploi/prof/'.$file_name); // storage/emploi/prof/lasfar.pdf
        if (Storage::exists('emploi/prof/'.$file_name))
        {
            return view('prof.emploi',['path_to_file' => $path_to_file, 'Mine' => 'true']);
        }
        return view('prof.emploi',['path_to_file' => 'notFound', 'Mine' => 'true']);
    }

    public function getEmploiByFiliere($id)
    {
        $idEmploi = Filiere::find($id)->idEmploi;
        if(is_null($idEmploi))
        {
            return view('prof.emploi',['path_to_file' => 'notFound', 'Mine' => 'false']);
        }
        echo $file_name = Emploi::find($idEmploi)->fileName;
        $path_to_file = asset('storage/emploi/filiere/'.$file_name);
        if (Storage::exists('emploi/filiere/'.$file_name))
        {;
            return view('prof.emploi',['path_to_file' => $path_to_file, 'Mine' => 'false']);
        }
            return view('prof.emploi',['path_to_file' => 'notFound', 'Mine' => 'false']);
    }


    public function getNote(Request $request, Note $note)  //an ajax function to retrieve tha data
    {

       $note = Note::where('idNote',$note->idNote)  //first inint a user id
       ->select('idNote','controle','exam','Coefcontrole','Coefexam')
       ->get();

       if ($request->ajax()) {
             echo json_encode($note);
        }
    }

    public function getEtudiantId(Request $request, Etudiant $etudiant)
    {
        if ($request->ajax()) {
            echo json_encode($etudiant->idEtudiant);
       }
    }
    public function updateNote(Request $request)
    {
        $control = request('control');
        $exam = request('exam');
        $coefcontrol = request('coefcontrol');
        $coefexam = request('coefexam');
        $idNote = request('idNote');
        $notegeneral = (($control*($coefcontrol/100))+($exam*($coefexam/100)));
        if($idNote!=null)
        {
            $note = Note::find($idNote);
            $note->controle = $control;
            $note->exam = $exam;
            $note->noteGeneral=$notegeneral;
            $note->Coefcontrole= $coefcontrol;
            $note->Coefexam=$coefexam;
            $note->save();
        }else{
            $note = new Note;
            $idEtudiant = request('idEtudiant');
            $idMatiere = request('idMatiere');
            $note->controle = $control;
            $note->exam = $exam;
            $note->noteGeneral=$notegeneral;
            $note->Coefcontrole= $coefcontrol;
            $note->Coefexam=$coefexam;
            $note->idEtudiant=$idEtudiant;
            $note->idMatiere=$idMatiere;
            $note->save();
        }

    }
}
