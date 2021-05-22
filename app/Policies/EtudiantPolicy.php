<?php

namespace App\Policies;

use App\Models\Chefdep;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class EtudiantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Etudiant  $etudiant
     * @return mixed
     */
    public function view(User $user, Etudiant $etudiant)
    {
        if($user->hasRole('chefdep')){
            $chefsDep = $user->professeur->chefdep->departement->idDepartement;
            $etudiants = Etudiant::join('filiere','filiere.idFiliere','etudiant.idFiliere')
                        ->where('idDepartement',$chefsDep)
                        ->pluck('idEtudiant')
                        ->toArray();
                        // dd($etudiant);
            return in_array($etudiant->idEtudiant, $etudiants);
        }
        else if($user->hasRole('prof')){
            $filieres = DB::table('matiere')
                ->where('idProf', $user->professeur->idProf)
                ->join('module','module.idModule','matiere.idModule')
                ->join('semestre','semestre.idSemestre','module.idSemestre')
                ->distinct()
                ->pluck('idFiliere')->toArray();
            return in_array($etudiant->idFiliere ,$filieres);
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Etudiant  $etudiant
     * @return mixed
     */
    public function update(User $user, Etudiant $etudiant)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Etudiant  $etudiant
     * @return mixed
     */
    public function delete(User $user, Etudiant $etudiant)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Etudiant  $etudiant
     * @return mixed
     */
    public function restore(User $user, Etudiant $etudiant)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Etudiant  $etudiant
     * @return mixed
     */
    public function forceDelete(User $user, Etudiant $etudiant)
    {
        //
    }
}
