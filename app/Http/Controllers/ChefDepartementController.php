<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmploiEmail;
use App\Jobs\SendNoteEmail;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;
use DataTables;

use App\Models\Absence;
use App\Models\Chefdep;
use App\Models\Emploi;
use App\Models\env_vars;
use App\Models\Etudiant;
use App\services\CalculeNotes;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Module;
use App\Models\Personne;
use App\Models\Prof_departement;
use App\Models\Professeur;
use App\Models\User;
use App\Notifications\AnunulerRattNotify;
use App\Notifications\NotifyRattAccepte;
use App\Notifications\NotifyRattAnnule;
use App\Notifications\RattAnunuleNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\IsNull;
use Illuminate\Support\Facades\DB;

class ChefDepartementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['chefdep']);
    }
    public function index()
    {
        //return list of profs in this department
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        /*$profs = Professeur::where('prof_departement.idDepartement',$idDepartement)
        ->join('prof_departement','professeur.idProf','prof_departement.idProf')
        ->join('users','users.id','=','professeur.idUtilisateur')
        ->select('professeur.idProf','users.name as nom')->get();*/

        //return list of filiere in that departement
        $filieres = Filiere::where('idDepartement', $idDepartement)->select('idFiliere', 'nom', 'niveau')->get();
        return view('Chef.emploi', ['filieres' => $filieres]);
    }


    public function getListOfFilieresEmploi(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $emplois = Filiere::where('idDepartement', $idDepartement)
            ->join('emploi', 'emploi.idEmploi', '=', 'filiere.idEmploi')
            ->select('emploi.idEmploi as idEmploi', 'filename', 'filiere.nom as nom', 'niveau', 'emploi.updated_at as UpdateDate')->get();

        if ($request->ajax()) {
            return Datatables::of($emplois)
                ->addColumn('filename', function ($row) {
                    $link_to_file = asset('storage/emploi/filiere/' . $row->filename);
                    $btn = '<a href="' . $link_to_file . '"  target="_blank" class="card-link text-primary" >' . $row->filename . '</a>';
                    return $btn;
                })
                ->editColumn('UpdateDate', function ($row) {
                    setlocale(LC_TIME, "fr_FR", "French");
                    return strftime("%A %d %B %G %R", strtotime($row->UpdateDate));
                })
                ->rawColumns(['action', 'filename'])
                ->make(true);
        }
    }

    public function Etudiants(Filiere $filiere)
    {
        $filieres = $filiere->departement->filieres;
        return view('Chef.Etudiant', ['filiere' => $filiere, 'filieres' => $filieres]);
    }

    public function getEtudiants(Request $request, Filiere $filiere)  //an ajax function to retrieve tha data
    {

        $etudiants = Etudiant::where('etudiant.idFiliere', $filiere->idFiliere)  //first inint a user id
            ->join('personne', 'etudiant.idPersonne', '=', 'personne.idPersonne') //retrieved matiere
            ->select('apogee', 'nom', 'prenom', 'cne', 'email', 'tel', 'idEtudiant')
            ->get();
        if ($request->ajax()) {
            return Datatables::of($etudiants)
                ->make(true);
        }
    }

    public function getEtudiantsForSelects(Request $request, Filiere $filiere)  //an ajax function to retrieve tha data
    {
        $etudiants = Etudiant::where('etudiant.idFiliere', $filiere->idFiliere)  //first inint a user id
            ->join('personne', 'etudiant.idPersonne', '=', 'personne.idPersonne') //retrieved matiere
            ->select('apogee', 'nom', 'prenom', 'cne', 'email', 'tel', 'idEtudiant')
            ->get();
        if ($request->ajax()) {
            echo json_encode($etudiants);
        }
    }

    public function getEtudiant(Request $request, Etudiant $etudiant)  //an ajax function to retrieve tha data
    {

        $etudiant = Etudiant::where('idEtudiant', $etudiant->idEtudiant)  //first inint a user id
            ->join('personne', 'etudiant.idPersonne', '=', 'personne.idPersonne') //retrieved matiere
            ->select('nom', 'prenom', 'apogee', 'cne', 'genre', 'dateNaissance', 'situationFamiliale', 'nationalite', 'lieuNaissance', 'cin', 'cinPere', 'cinMere', 'adressePersonnele', 'tel', 'email', 'emailInstitutionne', 'anneeDuBaccalaureat', 'regimeDeCovertureMedicale', 'etudiant.idEtudiant')
            ->get();
        if ($request->ajax()) {
            echo json_encode($etudiant);
        }
    }
    public function TransEtudiants()
    {
        $idFiliere = request('idFiliereT');
        $idFiliereTo = request('fil');
        $filiere = Filiere::find($idFiliere);
        $op = request('customRadio');
        if ($op == "T") {
            $etudiants = request('etudiantsauf');
            foreach ($filiere->Etudiants as $etudiant) {
                $check = 0;
                if ($etudiants != null) {
                    foreach ($etudiants as $idEtud) {
                        if ($etudiant->idEtudiant == $idEtud) {
                            $check++;
                            break;
                        }
                    }
                }
                if ($check == 0) {
                    $etudiant->idFiliere = $idFiliereTo;
                    $etudiant->save();
                }
            }
        } else if ($op == "S" && request('etudiantsel') != null) {
            $etudiants = request('etudiantsel');
            foreach ($etudiants as $idEtud) {
                $etudiant = Etudiant::find($idEtud);
                $etudiant->idFiliere = $idFiliereTo;
                $etudiant->save();
            }
        }
    }
    public function SupprimerEtudiant()
    {
        $idEtudiant = request('idEtudiant');
        $etudiant = Etudiant::find($idEtudiant);
        $idPersonne = $etudiant->idPersonne;
        $personne = Personne::find($idPersonne);
        $personne->delete();
    }
    public function deleteEmploi($idEmploi)
    {
        echo $idEmploi;
        $emploi = Emploi::find($idEmploi);
        $filename = $emploi->fileName;
        Storage::delete('emploi/prof/' . $filename);  //delete the physical file
        $emploi->delete();
        return redirect('/chef/emploi');
    }

    public function deleteEmploiFiliere()
    {
        $idEmploi = request('idEmploi');
        $emploi = Emploi::find($idEmploi);
        $filename = $emploi->fileName;
        Storage::delete('emploi/filiere/' . $filename);  //delete the physical file
        $emploi->delete();
    }

    public function uploadEmploi(Request $request)
    {
        $idFiliere =  $request->filiere;
        $file = $request->uploadedFile;
        $filiere = Filiere::where('idFiliere', $idFiliere)->select('idFiliere', 'nom as name', 'niveau', 'idEmploi')->get()[0];

        //echo $idFiliere.'<br>';
        //echo $filiere->nom;

        //add or update entry in emploi and filiere table
        if (is_null($filiere->idEmploi)) //then creat a new entry
        {
            $emploi = Emploi::create([
                'fileName' => $filiere->name . $filiere->niveau . '.pdf'
            ]);
            $file->storeAs('emploi/filiere/', $filiere->name . $filiere->niveau . '.pdf');  //store with the original name
            $emploi = Emploi::where('fileName', $filiere->name . $filiere->niveau . '.pdf')->select('idEmploi')->get()[0];
            $filiere = Filiere::find($idFiliere);
            $filiere->idEmploi = $emploi->idEmploi;
            $filiere->save();
        } else //meaning the filiere has already an emploi
        {
            //delete old file
            Storage::delete('emploi/filiere/' . $filiere->name . $filiere->niveau . '.pdf');
            //delete the old entry
            $oldEmploi = Emploi::find($filiere->idEmploi);
            $oldEmploi->delete();
            //add new one
            $emploi = Emploi::create([
                'fileName' => $filiere->name . $filiere->niveau . '.pdf'
            ]);
            $file->storeAs('emploi/filiere/', $filiere->name . $filiere->niveau . '.pdf');  //store with the original name
            $emploi = Emploi::where('fileName', $filiere->name . $filiere->niveau . '.pdf')->select('idEmploi')->get()[0];
            $filiere = Filiere::find($idFiliere);
            $filiere->idEmploi = $emploi->idEmploi;
            $filiere->save();
        }

        //mail the emploi to all students of the same filiere
        $filiere_ = Filiere::find($idFiliere);
        $filePath = 'emploi/filiere/' . $filiere_->nom . $filiere_->niveau . '.pdf';
        $etudiants = Etudiant::where('idFiliere', $idFiliere)->get();
        foreach ($etudiants as $etudiant) {
            $mailData = [
                'mailTo' => $etudiant->email, 'userName' => strval($etudiant->personne->nom . ' ' . $etudiant->personne->prenom),
                'nomfiliere' => $etudiant->filiere->nom, 'filePath' => $filePath, 'niveau' => $filiere_->niveau
            ];
            SendEmploiEmail::dispatch($mailData);
        }
        return redirect('/chef/emploi'); //just in case
    }
    public function UpdateEtudiant()
    {
        $idEtudiant = request('inIdEtudiant');
        $etudiant = Etudiant::find($idEtudiant);
        $idPersonne = $etudiant->idPersonne;
        $personne = Personne::find($idPersonne);
        request()->validate(
            [
                'inIdEtudiant' => 'required',
                'innom' => 'required',
                'inprenom' => 'required',
                'insituation' => 'required',
                'ingenre' => 'required',
                'indatenais' => ['required', 'date'],
                'innationalite' => 'required',
                'inLieuNaissance' => 'required',
                'inadresse' => 'required',
                'incin' => ['required', 'unique:personne,cin,' . $personne->idPersonne . ',idPersonne'],
                'intel' => 'required',
                'inemail' => ['required', 'email', 'unique:etudiant,email,' . $etudiant->idEtudiant . ',idEtudiant'],
                'inemailins' => ['required', 'email', 'unique:personne,emailInstitutionne,' . $personne->idPersonne . ',idPersonne'],
                'inapogee' => ['required', 'unique:etudiant,apogee,' . $etudiant->idEtudiant . ',idEtudiant'],
                'incne' => ['required', 'unique:etudiant,cne,' . $etudiant->idEtudiant . ',idEtudiant'],
                'incinpere' => 'required',
                'incinmere' => 'required',
                'inannebac' => 'required',
                'incouv' => 'required'
            ],
            [
                'incin.unique' => 'C.N.I.E est déjà existé.',
                'inemail.unique' => 'Email est déjà utilisée.',
                'inemailins.unique' => 'Email est déjà utilisée.',
                'incne.unique' => 'CNE est déjà existé.',
                'inapogee.unique' => 'Numéro apogée est déjà utilisée.',
                'inemail.email' => 'Email invalide.',
                'inemailins.email' => 'Email invalide.'
            ]
        );
        $personne->nom = request('innom');
        $personne->prenom = request('inprenom');
        $personne->situationFamiliale = request('insituation');
        $personne->genre = request('ingenre');
        $personne->dateNaissance = request('indatenais');
        $personne->nationalite = request('innationalite');
        $personne->lieuNaissance = request('inLieuNaissance');
        $personne->adressePersonnele = request('inadresse');
        $personne->cin = request('incin');
        $personne->tel = request('intel');
        $personne->emailInstitutionne = request('inemailins');
        $etudiant->apogee = request('inapogee');
        $etudiant->cne = request('incne');
        $etudiant->email = request('inemail');
        $etudiant->cinPere = request('incinpere');
        $etudiant->cinMere = request('incinmere');
        $etudiant->anneeDuBaccalaureat = request('inannebac');
        $etudiant->regimeDeCovertureMedicale = request('incouv');
        $personne->save();
        $etudiant->save();
    }

    public function Matieres(Filiere $filiere)
    {
        return view('Chef.matieres', ['filiere' => $filiere]);
    }

    public function getNotes(Matiere $matiere)
    {
        return view('Chef.Notes', ['matiere' => $matiere]);
    }

    public function getListNotes(Request $request, Matiere $matiere)  //an ajax function to retrieve tha data
    {
        $idFiliere = $matiere->module->semestre->filiere->idFiliere;
        $notes = Etudiant::where('filiere.idFiliere', $idFiliere)  //first inint a user id
            ->join('filiere', 'etudiant.idFiliere', '=', 'filiere.idFiliere')
            ->join('departement', 'departement.idDepartement', '=', 'filiere.idDepartement')
            ->join('personne', 'etudiant.idPersonne', '=', 'personne.idPersonne')
            ->leftJoin('note', function ($q) use ($matiere) {
                $q->on('note.idEtudiant', '=', 'etudiant.idEtudiant')
                    ->where('note.idMatiere', '=', "$matiere->idMatiere");
            })
            ->select('apogee', 'personne.nom', 'insertion_notes as etat', 'personne.prenom', 'cne', 'controle', 'exam', 'noteRatt', 'noteGeneral', 'idNote', 'etudiant.idEtudiant')
            ->get();
        if ($request->ajax()) {
            return Datatables::of($notes)
                ->make(true);
        }
    }
    public function Professeurs(Departement $departement)
    {
        return view('Chef.profs', ['departement' => $departement]);
    }

    public function getProfesseurs(Request $request, Departement $departement)
    {
        $professeurs = Departement::where('departement.idDepartement', $departement->idDepartement)  //first inint a user id
            ->join('prof_departement', 'departement.idDepartement', '=', 'prof_departement.idDepartement')
            ->join('professeur', 'prof_departement.idProf', '=', 'professeur.idProf')
            ->join('users', 'professeur.idUtilisateur', '=', 'users.id')
            ->join('personne', 'users.idPersonne', '=', 'personne.idPersonne')
            ->select('professeur.idProf', 'personne.nom', 'personne.prenom', 'professeur.specialite', 'email', 'tel',)
            ->get();
        if ($request->ajax()) {
            return Datatables::of($professeurs)
                ->make(true);
        }
    }

    public function getProfesseur(Request $request, Professeur $professeur)
    {
        $professeurs = Professeur::where('professeur.idProf', $professeur->idProf)  //first inint a user id
            ->join('users', 'professeur.idUtilisateur', '=', 'users.id')
            ->join('personne', 'users.idPersonne', '=', 'personne.idPersonne')
            ->select('professeur.idProf', 'personne.nom', 'personne.prenom', 'professeur.specialite', 'email', 'tel', 'dateNaissance', 'nationalite', 'lieuNaissance', 'situationFamiliale', 'genre', 'cin', 'adressePersonnele', 'emailInstitutionne')
            ->get();

        $matieres = Matiere::where('idProf', $professeur->idProf)
            ->select('nom')->get();

        $data = array();
        $data['prof'] = $professeurs;
        $data['matieres'] = $matieres;

        if ($request->ajax()) {
            echo json_encode($data);
        }
    }

    public function getMatiere(Professeur $professeur, Departement $departement) //get Matiere based on idFiliere
    {
        $MatieresList = array();
        foreach ($professeur->matieres as $matiere) {
            if ($matiere->module->semestre->filiere->departement->idDepartement == $departement->idDepartement) {
                array_push($MatieresList, $matiere);
            }
        }
        echo json_encode($MatieresList);
    }

    public function AffecterMatiere()
    {
        $idProf = request('prof');
        $idMatiere = request('matiereafect');
        $idDepartement = request('depA');
        $matiere = Matiere::find($idMatiere);
        $matiere->idProf = $idProf;
        $matiere->save();
        $professeur = Professeur::find($idProf);
        $MatieresList = array();
        $departement = Departement::find($idDepartement);
        foreach ($professeur->matieres as $mat) {
            if ($mat->module->semestre->filiere->departement->idDepartement == $departement->idDepartement) {
                array_push($MatieresList, $mat);
            }
        }
        return json_encode($MatieresList);
    }
    public function DetacherMatiere()
    {
        $idMatiere = request('matiere');
        $idProf = request('profdet');
        $idDepartement = request('depD');
        $matiere = Matiere::find($idMatiere);
        $matiere->idProf = null;
        $matiere->save();
        $professeur = Professeur::find($idProf);
        $MatieresList = array();
        $departement = Departement::find($idDepartement);
        foreach ($professeur->matieres as $mat) {
            if ($mat->module->semestre->filiere->departement->idDepartement == $departement->idDepartement) {
                array_push($MatieresList, $mat);
            }
        }
        return json_encode($MatieresList);
    }
    public function AbsencesIndex() //load abseces and return view for /chef/absence
    {
        return view('Chef.absences');
    }

    public function getAbsencesForChef(Request $request)
    {
        //get the departement id of the current chef
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        //get all profs within the same departement
        $profs = Prof_departement::where('idDepartement', $idDepartement)->select('idProf')->get()->toArray();

        $absences = Absence::whereIn('absence.idProf', $profs)
            ->where('filiere.idDepartement', $idDepartement)
            ->join('professeur', 'absence.idProf', '=', 'professeur.idProf')
            ->join('matiere', 'absence.idMatiere', 'matiere.idMatiere')
            ->join('module', 'module.idModule', '=', 'matiere.idModule') //retrieved matiere
            ->join('semestre', 'semestre.idSemestre', '=', 'module.idSemestre')
            ->join('filiere', 'semestre.idFiliere', '=', 'filiere.idFiliere')
            ->join('users', 'users.id', '=', 'professeur.idUtilisateur')
            ->join('personne', 'personne.idPersonne', 'users.idPersonne')
            ->select('idAbsence', 'matiere.nom as nomMatiere', DB::raw("concat_ws(' ',filiere.nom, filiere.niveau) AS nomFiliere"), DB::raw("concat_ws(' ',personne.nom, personne.prenom) AS nomProf"), 'absence.dateAbsence as date', 'absence.etat')
            ->get();

        if ($request->ajax()) {
            return Datatables::of($absences)
                ->addColumn('etat', function ($row) {
                    $btn = ' ';
                    if ($row->etat == 'rattrapée') {
                        $btn = '<span style="background-color: #33cc33;" class="badge badge-pill">Rattrapé</span>';
                    } else if ($row->etat == 'annulé') {
                        $btn = '<span style="background-color: #ff4d4d;" class="badge badge-pill">annulé</span>';
                    } else {
                        $btn = '<span style="background-color: #ff4d4d;" class="badge badge-pill">En attend</span>';
                    }
                    return $btn;
                })
                ->addColumn('date', function ($row) {
                    setlocale(LC_TIME, "fr_FR", "French");
                    return strftime("%A %d %B %G %R", strtotime($row->date));
                })
                ->rawColumns(['etat', 'date'])
                ->make(true);
        }
    }

    public function getChefDashboard()
    {
        $annee = date("Y") . "/" . (date("Y") - 1);
        $date = date("j/n/Y");
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        //get the count of students in the same departement
        $Count_etudiants = Filiere::where('idDepartement', $idDepartement)
            ->join('etudiant', 'etudiant.idFiliere', '=', 'filiere.idFiliere')
            ->count();

        //filieres count
        $Count_filieres = Filiere::where('idDepartement', $idDepartement)->count();

        //get absences count (of profs within the same dep)
        $profs = Prof_departement::where('idDepartement', $idDepartement)
            ->select('idProf')->get()->toArray();

        $Count_absences = Absence::whereIn('absence.idProf', $profs)
            ->where('filiere.idDepartement', $idDepartement)
            ->join('professeur', 'absence.idProf', '=', 'professeur.idProf')
            ->join('matiere', 'absence.idMatiere', 'matiere.idMatiere')
            ->join('module', 'module.idModule', '=', 'matiere.idModule') //retrieved matiere
            ->join('semestre', 'semestre.idSemestre', '=', 'module.idSemestre')
            ->join('filiere', 'semestre.idFiliere', '=', 'filiere.idFiliere')
            ->join('users', 'users.id', '=', 'professeur.idUtilisateur')
            ->join('personne', 'personne.idPersonne', 'users.idPersonne')
            ->count();

        $etat_notes = Departement::find($idDepartement)->insertion_notes;

        //echo $annee.'<br>'.$date.'<br>'.$Count_etudiants.'<br>'.$Count_filieres.'<br>'.$Count_absences.'<br>'.$etat_notes;

        return view('Chef.TableBoard', [
            'annee' => $annee, 'date' => $date, 'Count_etudiants' => $Count_etudiants,
            'Count_filieres' => $Count_filieres, 'Count_absences' => $Count_absences, 'etat_notes' => $etat_notes
        ]);
    }

    public function getAbsencesListForChefDashboard(Request $request)
    {
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $profs = Prof_departement::where('idDepartement', $idDepartement)->select('idProf')->get()->toArray();
        $absences = Absence::whereIn('absence.idProf', $profs)
            ->where('absence.etat', 'en attendant')
            ->where('filiere.idDepartement', $idDepartement)
            ->join('professeur', 'absence.idProf', '=', 'professeur.idProf')
            ->join('matiere', 'absence.idMatiere', 'matiere.idMatiere')
            ->join('module', 'module.idModule', '=', 'matiere.idModule') //retrieved matiere
            ->join('semestre', 'semestre.idSemestre', '=', 'module.idSemestre')
            ->join('filiere', 'semestre.idFiliere', '=', 'filiere.idFiliere')
            ->join('users', 'users.id', '=', 'professeur.idUtilisateur')
            ->join('personne', 'personne.idPersonne', 'users.idPersonne')
            ->select('absence.IdAbsence as IdAbsence', 'personne.nom as nomProf', 'absence.dateAbsence as dateAbsence')
            ->get();

        if ($request->ajax()) {
            return Datatables::of($absences)
                ->addColumn('dateAbsence', function ($row) {
                    setlocale(LC_TIME, "fr_FR", "French");
                    return strftime("%A %d %B %G %R", strtotime($row->dateAbsence));
                })
                ->rawColumns(['dateAbsence'])
                ->make(true);
        }
    }

    public function RattrapagesIndex()
    {
        //get list of absences within the same departement
        // (profName + absence_date + possible ratt dates + salle ) on condition etat = en attendant

        //get all profs in the same departement
        $idDepartement = auth()->user()->professeur->chefdep->idDepartement;
        $profs = Prof_departement::where('idDepartement', $idDepartement)->select('idProf')->get()->toArray();
        $absences = Absence::whereIn('absence.idProf', $profs)
            ->where('absence.etat', 'en attendant')
            ->where('filiere.idDepartement', $idDepartement)
            ->join('professeur', 'absence.idProf', '=', 'professeur.idProf')
            ->join('matiere', 'absence.idMatiere', 'matiere.idMatiere')
            ->join('module', 'module.idModule', '=', 'matiere.idModule') //retrieved matiere
            ->join('semestre', 'semestre.idSemestre', '=', 'module.idSemestre')
            ->join('filiere', 'semestre.idFiliere', '=', 'filiere.idFiliere')
            ->join('users', 'users.id', '=', 'professeur.idUtilisateur')
            ->join('personne', 'personne.idPersonne', 'users.idPersonne')
            ->get();

        return view('Chef.rattrapage', ['absences' => $absences]);
    }

    public function AnnulerRatt(Request $request, Absence $absence)
    {
        //get the old absence instance of absence and update it
        $absence->etat = 'annulé';
        $absence->save();

        //send notification to the prof that his absence has been rejected
        $absence->professeur->user->notify(new NotifyRattAnnule(Auth::user(), $absence));
        // end

        return redirect('/chef/rattrapages');
    }

    public function ValiderRatt(Request $request,Absence $absence)
    {
        $absence->etat = 'rattrapée';  //validée
        $absence->salle = $request->salle;
        if (!is_null($request->dateRattOptionnel)) {
            $absence->dateRattrapage = $request->dateRattOptionnel;
        } else {
            $absence->dateRattrapage = $request->datesRattPossibles;
        }
        $absence->save();

        //send notification to the prof that his absence is valideated
        $absence->professeur->user->notify(new NotifyRattAccepte(Auth::user(), $absence));

        return redirect('/chef/rattrapages');
    }

    public function mode(Request $request)
    {

        // if(!$request->session()->exists('changeView'))
        //     $request->session()->put('changeView',1);

        if ($request->session()->get('changeView') == 0) {
            $request->session()->put('changeView', 1);
            return redirect('/Dashboard');
        } else {
            $request->session()->put('changeView', 0);
            return redirect('chef/dashboard');
        }
        return redirect('/');
    }

    public function getResulatEtudiant(Etudiant $etudiant)
    {
        $filieres = array();
        foreach ($etudiant->notes as $note) {
            array_push($filieres, $note->matiere->module->semestre->filiere);
        }
        array_push($filieres, $etudiant->filiere);
        $filieres = array_unique($filieres);
        $filieresnotes = array();
        $consratt = -100;
        $consval = 12000;
        $val = env_vars::where('name', 'ConstantVal')->select('id', 'value')->get();
        $rat = env_vars::where('name', 'ConstantRat')->select('id', 'value')->get();
        if (!$rat->isEmpty() && !$val->isEmpty()) {
            $val = $val->toArray();
            $rat = $rat->toArray();
            $consval = $val[0]['value'];
            $consratt = $rat[0]['value'];
        }
        foreach ($filieres as $filiere) {
            $calc = new CalculeNotes($filiere, $etudiant, $consval, $consratt);
            $noteSemestres = array();
            $noteModules = array();
            foreach ($filiere->semestres as $semestre) {
                array_push($noteSemestres, array('idSemestre' => $semestre->idSemestre, 'noteNormal' => $calc->CalcSemestreNormal($semestre->idSemestre), 'noteRatt' => $calc->CalcSemestreRatt($semestre->idSemestre), 'etat' => $calc->EtatSemestre($semestre->idSemestre), 'CheckNormal' => $calc->CheckSemestreNormal($semestre->idSemestre), 'CheckRatt' => $calc->CheckSemestreRatt($semestre->idSemestre), 'etatRatt' => $calc->EtatSemestreRatt($semestre->idSemestre)));
            }
            foreach ($filiere->semestres as $semestre) {
                foreach ($semestre->modules as $module) {
                    array_push($noteModules, array('idModule' => $module->idModule, 'noteNormal' => $calc->CalcModuleNormal($module->idModule), 'noteRatt' => $calc->CalcModuleRatt($module->idModule)));
                }
            }
            array_push($filieresnotes, array(
                "filiere" => $filiere,
                "noteAnne" => $calc->CalcAnneNormal(),
                "noteRatt" => $calc->CalcAnneRatt(),
                "noteSemestres" => $noteSemestres,
                "noteModules" => $noteModules,
                "CheckAnne" => $calc->CheckAnne(),
                "CheckAnneRatt" => $calc->CheckRatt()
            ));
        }
        return view('Chef.resultat', ['filieresnotes' => $filieresnotes, 'etudiant' => $etudiant, 'consratt' => $consratt, 'consval' => $consval]);
    }
    public function EnvoyerNotes()
    {
        $idFiliere = request('idFiliereResultat');
        $filiere = Filiere::find($idFiliere);
        if ($filiere) {
            foreach ($filiere->Etudiants as $etudiant) {
                $mailData = [
                    'mailTo' => $etudiant->email, 'etudiant' => $etudiant, 'filiere' => $filiere,
                ];
                SendNoteEmail::dispatch($mailData);
            }
        }
    }
    public function EnvoyerNote()
    {
        $idEtudiant = request('idEtudiantResultat');
        $etudiant = Etudiant::find($idEtudiant);
        if ($etudiant) {
            $idFiliere = $etudiant->filiere->idFiliere;
            $filiere = Filiere::find($idFiliere);
            $mailData = [
                'mailTo' => $etudiant->email, 'etudiant' => $etudiant, 'filiere' => $filiere,
            ];
            SendNoteEmail::dispatch($mailData);
        }
    }
}
