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
        ->select('emploi.idEmploi as idEmploi','filename','users.name as nom','emploi.updated_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('filename', function($row)
            {
                $link_to_file = asset('storage/emploi/prof/'.$row->filename);
                $btn = '<a class="card-link text-primary" href="' .$link_to_file. '" target="_blank" >' .$row->filename. '</a>';
                return $btn;
            })
            ->addColumn('date', function($row)
            {
                setlocale(LC_TIME, "fr_FR", "French");
                return strftime("%A %d %B %G %R", strtotime($row->date));
            })
            ->rawColumns(['filename','date'])
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

    public function FetchDashboardData()
    {
        $annee = date("Y")."/".(date("Y")-1);
        $date = date("j/n/Y");

        //totla etudiants count
        $CountEtudiant = Etudiant::all()->count();

        //total nbre dep
        $CountDepartement = Departement::all()->count();

        //totla nbre des filieres
        $CountFiliere = Filiere::all()->count();

        //total nbre of profs without emploi
        $CountProf = Professeur::whereNull('idEmploi')->count();

        return view('admin.TableBoard',['annee' => $annee , 'date' => $date , 'CountEtudiant' => $CountEtudiant ,
        'CountDepartement' => $CountDepartement ,'CountFiliere' => $CountFiliere , 'CountProf' => $CountProf]);
    }

    public function adminDashboardTable(Request $request)
    {
        $profs = Professeur::whereNull('idEmploi')
        ->join('users','professeur.idUtilisateur','users.id')
        ->select('idProf','users.name as nomProf','specialite')
        ->get();

        if ($request->ajax()) {
            return Datatables::of($profs)
            ->make(true);
        }
    }

    public function indexEmploiFiliere()
    {
        return view('admin.emploiFiliere');
    }

    public function getAdminEmploiFiliereDatatable(Request $request)
    {
        $emplois = Filiere::join('emploi','emploi.idEmploi','filiere.idEmploi')
        ->select('emploi.idEmploi as idEmploi','filename','filiere.nom as nom','niveau','emploi.updated_at as date')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
            ->addColumn('filename', function($row)
            {
                $link_to_file = asset('storage/emploi/filiere/'.$row->filename);
                $btn = '<a href="' .$link_to_file. '"  target="_blank" class="card-link text-primary" >' .$row->filename. '</a>';
                return $btn;
            })
            ->addColumn('date', function($row)
            {
                setlocale(LC_TIME, "fr_FR", "French");
                return strftime("%A %d %B %G %R", strtotime($row->date));
            })
            ->rawColumns(['filename','date'])
            ->make(true);
        }
    }
}
