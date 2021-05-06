<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use DataTables;

use App\Models\Absence;
use App\Models\Chefdep;
use App\Models\Emploi;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Module;
use App\Models\Personne;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $profs = Professeur::join('users','users.id','=','professeur.idUtilisateur')
        ->select('idProf','users.name as nom')->get();

        return view('admin.emploi',['profs' => $profs]);
    }

    public function getListOfProfEmploi(Request $request)
    {
        $emplois = Professeur::join('users','users.id','=','professeur.idUtilisateur')
        ->join('emploi','emploi.idEmploi','=','professeur.idEmploi')
        ->select('emploi.idEmploi as idEmploi','filename','users.name as nom','emploi.created_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('filename', function($row)
            {
                $link_to_file = asset('storage/emploi/prof/'.$row->filename);
                $btn = '<a class="card-link text-primary" href="' .$link_to_file. '" target="_blank" >' .$row->filename. '</a>';
                return $btn;
            })
            ->rawColumns(['filename'])
            ->make(true);
        }
    }

    public function uploadEmploi(Request $request)
    {
        $idProf =  $request->prof;
        $file = $request->uploadedFile;

        $prof = Professeur::where('idProf',$idProf)
        ->join('users','professeur.idUtilisateur','=','users.id')
        ->select('users.id','users.name as name','idEmploi','idProf')
        ->get()[0];

        //echo $idProf.'<br>';
        //echo $prof->name;

        //add or update entry in emploi and professeur table
        if(is_null($prof->idEmploi)) //then creat a new entry
        {
            $emploi = Emploi::create([
                'fileName' => $prof->name.'.pdf',
                'created_at' => '',
            ]);

            $file->storeAs('emploi/prof/', $prof->name.'.pdf');  //store with the original name

            $emploi = Emploi::where('fileName',$prof->name.'.pdf')->select('idEmploi')->get()[0];
            $prof = Professeur::find($idProf);
            $prof->idEmploi = $emploi->idEmploi;
            $prof->save();
        }
        else //meaning the prof has already an emploi
        {
            //delete old file
            Storage::delete('emploi/prof/', $prof->name.'.pdf');
            //delete the old entry
            $oldEmploi = Emploi::find($prof->idEmploi);
            $oldEmploi->delete();

            //add new one
            $emploi = Emploi::create([
                'fileName' => $prof->name.'.pdf',
                'created_at' => '',
            ]);

            $file->storeAs('emploi/prof/', $prof->name.'.pdf');  //store with the original name

            $emploi = Emploi::where('fileName',$prof->name.'.pdf')->select('idEmploi')->get()[0];
            $prof = Professeur::find($idProf);
            $prof->idEmploi = $emploi->idEmploi;
            $prof->save();
        }
        return redirect('admin/emploi'); //just in case*/
    }

    public function deleteEmploiProf()
    {
        $idEmploi = request('idEmploi');
        $emploi = Emploi::find($idEmploi);
        $filename = $emploi->fileName;
        Storage::delete('emploi/prof/'.$filename);  //delete the physical file
        $emploi->delete();
    }

    public function getFilieres(Departement $departement)
    {
        return view('admin.filieres',['departement' => $departement]);
    }
    
    public function Etudiants(Filiere $filiere)
    {
        return view('admin.Etudiant', ['filiere' => $filiere]);
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
       ->select('nom','prenom','apogee','cne','genre','dateNaissance','situationFamiliale','nationalite','lieuNaissance','cin','cinPere','cinMere','adressePersonnele','tel','email','emailInstitutionne','anneeDuBaccalaureat','regimeDeCovertureMedicale','etudiant.idEtudiant')
       ->get();
       if ($request->ajax()) {
            echo json_encode($etudiant);
        }
    }
    
    public function SupprimerEtudiant()
    {
        $idEtudiant = request('idEtudiant');
        $etudiant = Etudiant::find($idEtudiant);
        $idPersonne = $etudiant->idPersonne;
        $personne = Personne::find($idPersonne);
        $etudiant->delete();
        $personne->delete();
    }

    public function UpdateEtudiant()
    {
        request()->validate([
            'inIdEtudiant' => 'required',
            'innom' => 'required',
            'inprenom' => 'required',
            'insituation' => 'required',
            'ingenre' => 'required',
            'indatenais' => ['required','date'],
            'innationalite' => 'required',
            'inLieuNaissance' => 'required',
            'inadresse' => 'required',
            'incin' => 'required',
            'intel' => 'required',
            'inemail' => ['required','email'],
            'inemailins' => ['required','email'],
            'inapogee' => 'required',
            'incne' => 'required',
            'incinpere' => 'required',
            'incinmere' => 'required',
            'inannebac' => 'required',
            'incouv' => 'required'
        ]);
        $idEtudiant=request('inIdEtudiant');
        $etudiant = Etudiant::find($idEtudiant);
        $idPersonne = $etudiant->idPersonne;
        $personne = Personne::find($idPersonne);
        $personne->nom=request('innom');
        $personne->prenom=request('inprenom');
        $personne->situationFamiliale=request('insituation');
        $personne->genre=request('ingenre');
        $personne->dateNaissance=request('indatenais');
        $personne->nationalite=request('innationalite');
        $personne->lieuNaissance=request('inLieuNaissance');
        $personne->adressePersonnele=request('inadresse');
        $personne->cin=request('incin');
        $personne->tel=request('intel');
        $personne->emailInstitutionne=request('inemailins');
        $etudiant->apogee=request('inapogee');
        $etudiant->cne=request('incne');
        $etudiant->email=request('inemail');
        $etudiant->cinPere=request('incinpere');
        $etudiant->cinMere=request('incinmere');
        $etudiant->anneeDuBaccalaureat=request('inannebac');
        $etudiant->regimeDeCovertureMedicale=request('incouv');
        $personne->save();
        $etudiant->save();
    }

    public function AjouterEtudiant()
    {
        request()->validate([
            'idFiliere' => 'required',
            'ajnom' => 'required',
            'ajprenom' => 'required',
            'ajsituation' => 'required',
            'ajgenre' => 'required',
            'ajdatenais' => ['required','date'],
            'ajnationalite' => 'required',
            'ajLieuNaissance' => 'required',
            'ajadresse' => 'required',
            'ajcin' => 'required',
            'ajtel' => 'required',
            'ajemail' => ['required','email'],
            'ajemailins' => ['required','email'],
            'ajapogee' => 'required',
            'ajcne' => 'required',
            'ajcinpere' => 'required',
            'ajcinmere' => 'required',
            'ajannebac' => 'required',
            'ajcouv' => 'required'
        ]);
        $idFiliere=request('idFiliere');
        $etudiant = new Etudiant;
        $personne = Personne::create([
            'nom' => request('ajnom'),
            'prenom' => request('ajprenom'),
            'situationFamiliale' => request('ajsituation'),
            'genre' => request('ajgenre'),
            'dateNaissance' => request('ajdatenais'),
            'nationalite' => request('ajnationalite'),
            'lieuNaissance' => request('ajLieuNaissance'),
            'adressePersonnele' => request('ajadresse'),
            'cin' => request('ajcin'),
            'tel' => request('ajtel'),
            'emailInstitutionne' => request('ajemailins')
        ]);
        $personne->nom=request('ajnom');
        $personne->prenom=request('ajprenom');
        $personne->situationFamiliale=request('ajsituation');
        $personne->genre=request('ajgenre');
        $personne->dateNaissance=request('ajdatenais');
        $personne->nationalite=request('ajnationalite');
        $personne->lieuNaissance=request('ajLieuNaissance');
        $personne->adressePersonnele=request('ajadresse');
        $personne->cin=request('ajcin');
        $personne->tel=request('ajtel');
        $personne->emailInstitutionne=request('ajemailins');
        $personne->save();
        $Personne = Personne::where('emailInstitutionne',request('ajemailins'))->select('idPersonne')->get()[0];
        $etudiant->apogee=request('ajapogee');
        $etudiant->cne=request('ajcne');
        $etudiant->email=request('ajemail');
        $etudiant->cinPere=request('ajcinpere');
        $etudiant->cinMere=request('ajcinmere');
        $etudiant->anneeDuBaccalaureat=request('ajannebac');
        $etudiant->regimeDeCovertureMedicale=request('ajcouv');
        $etudiant->idFiliere=$idFiliere;
        $etudiant->idPersonne=$Personne->idPersonne;
        $etudiant->save();
    }
}
