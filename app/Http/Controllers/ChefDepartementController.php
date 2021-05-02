<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use DataTables;

use App\Models\Absence;
use App\Models\Emploi;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Module;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChefDepartementController extends Controller
{
    public function index()
    {
        //return list of profs in this department
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $profs = Professeur::where('idDepartement',$idDepartement)
        ->join('users','users.id','=','professeur.idUtilisateur')
        ->select('idProf','users.name as nom')->get();

        //return list of filiere in that departement
        $filieres = Filiere::where('idDepartement',$idDepartement)->select('idFiliere','nom','niveau')->get();
        return view('chef.emploi',['profs' => $profs , 'filieres' => $filieres]);
    }

    public function getListOfProfEmploi(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $emplois = Professeur::where('idDepartement',$idDepartement)
        ->join('users','users.id','=','professeur.idUtilisateur')
        ->join('emploi','emploi.idEmploi','=','professeur.idEmploi')
        ->select('emploi.idEmploi as idEmploi','filename','users.name as nom','emploi.created_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('filename', function($row)
            {
                $link_to_file = asset('storage/emploi/prof/'.$row->filename);
                $btn = '<a class="text-success" href="' .$link_to_file. '" target="_blank" >' .$row->filename. '</a>';
                return $btn;
            })
            ->addColumn('action', function($row)
            {
                $btn = '<a href="emploi/delete/prof/'.$row->idEmploi.'" class="edit btn btn-outline-danger btn-sm">Supprimer</i></a>';
                return $btn;
            })
            ->rawColumns(['action','filename'])
            ->make(true);
        }
    }

    public function getListOfFilieresEmploi(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $emplois = Filiere::where('idDepartement',$idDepartement)
        ->join('emploi','emploi.idEmploi','=','filiere.idEmploi')
        ->select('emploi.idEmploi as idEmploi','filename','filiere.nom as nom','emploi.created_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('filename', function($row)
            {
                $link_to_file = asset('storage/emploi/filiere/'.$row->filename);
                $btn = '<a class="text-success" href="' .$link_to_file. '" target="_blank" >' .$row->filename. '</a>';
                return $btn;
            })
            ->addColumn('action', function($row)
            {
                $btn = '<a href="emploi/delete/filiere/'.$row->idEmploi.'" class="edit btn btn-outline-danger btn-sm">Supprimer</a>';
                return $btn;
            })
            ->rawColumns(['action','filename'])
             ->make(true);
        }
    }

    public function Etudiants(Filiere $filiere)
    {
        return view('chef.Etudiant', ['filiere' => $filiere]);
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

    public function deleteEmploiProf($idEmploi)
    {
        echo $idEmploi;
        $emploi = Emploi::find($idEmploi);
        $filename = $emploi->fileName;
        Storage::delete('emploi/prof/'.$filename);  //delete the physical file
        $emploi->delete();
        return redirect('/chef/emploi');
    }

    public function deleteEmploiFiliere($idEmploi)
    {
        echo $idEmploi;
        $emploi = Emploi::find($idEmploi);
        $filename = $emploi->fileName;
        Storage::delete('emploi/filiere/'.$filename);  //delete the physical file
        $emploi->delete();
        return redirect('/chef/emploi');
    }

    public function uploadEmploi(Request $request)
    {
        $selection =  $request->ProfOrFiliere;
        $file = $request->uploadedFile;

        if($selection[0] == 'p') //means we're uploading emploi for a prof
        {
            //store the file
            $idProf = substr($selection,1);
            $prof = Professeur::where('idProf',$idProf)->join('users','professeur.idUtilisateur','=','users.id')
            ->select('users.id','users.name as name','idEmploi','idProf')
            ->get()[0];

            echo $idProf.'<br>';
            echo $prof->name;

            //add or update entry in emploi and professeur table
            if(is_null($prof->idEmploi)) //then creat a new entry
            {
                $emploi = Emploi::create([
                    'fileName' => $prof->name.'.pdf'
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
                    'fileName' => $prof->name.'.pdf'
                ]);

                $file->storeAs('emploi/prof/', $prof->name.'.pdf');  //store with the original name

                $emploi = Emploi::where('fileName',$prof->name.'.pdf')->select('idEmploi')->get()[0];
                $prof = Professeur::find($idProf);
                $prof->idEmploi = $emploi->idEmploi;
                $prof->save();
            }

        }
        elseif($selection[0] == 'f') //means we're uploading emploi for a filiere
        {
            $idFiliere = substr($selection,1);
            $filiere = Filiere::where('idFiliere',$idFiliere)->select('idFiliere','nom as name','idEmploi')->get()[0];

            echo $idFiliere.'<br>';
            echo $filiere->nom;

            //add or update entry in emploi and filiere table
            if(is_null($filiere->idEmploi)) //then creat a new entry
            {
                $emploi = Emploi::create([
                    'fileName' => $filiere->name.'.pdf'
                ]);

                $file->storeAs('emploi/filiere/', $filiere->name.'.pdf');  //store with the original name

                $emploi = Emploi::where('fileName',$filiere->name.'.pdf')->select('idEmploi')->get()[0];
                $filiere = Filiere::find($idFiliere);
                $filiere->idEmploi = $emploi->idEmploi;
                $filiere->save();
            }
            else //meaning the filiere has already an emploi
            {
                //delete old file
                Storage::delete('emploi/filiere/', $filiere->name.'.pdf');
                //delete the old entry
                $oldEmploi = Emploi::find($filiere->idEmploi);
                $oldEmploi->delete();

                //add new one
                $emploi = Emploi::create([
                    'fileName' => $filiere->name.'.pdf'
                ]);

                $file->storeAs('emploi/filiere/', $filiere->name.'.pdf');  //store with the original name

                $emploi = Emploi::where('fileName',$filiere->name.'.pdf')->select('idEmploi')->get()[0];
                $filiere = Filiere::find($idFiliere);
                $filiere->idEmploi = $emploi->idEmploi;
                $filiere->save();
            }
        }
        else
        {
            return redirect('/chef/emploi'); //just in case
        }
    }
}
