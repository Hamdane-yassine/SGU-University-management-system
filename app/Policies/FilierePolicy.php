<?php

namespace App\Policies;

use App\Models\Chefdep;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class FilierePolicy
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
     * @param  \App\Models\Filiere  $filiere
     * @return mixed
     */
    public function view(User $user, Filiere $filiere)
    {
        if($user->hasRole('prof') || request()->session()->get('changeView') == 1){
            $filieres = DB::table('matiere')
                ->join('module','matiere.idModule','module.idModule')
                ->join('semestre','semestre.idSemestre','module.idSemestre')
                ->where('idProf', Chefdep::find($user->id)->professeur->idProf)
                ->distinct()
                ->pluck('idFiliere')->toArray();
            return in_array($filiere->idFiliere ,$filieres);
        }
        else if($user->hasRole('prof') || !request()->session()->exists('changeView')){
            $filieres = DB::table('matiere')
                ->join('module','matiere.idModule','module.idModule')
                ->join('semestre','semestre.idSemestre','module.idSemestre')
                ->where('idProf', $user->professeur->idProf)
                ->distinct()
                ->pluck('idFiliere')->toArray();
            return in_array($filiere->idFiliere ,$filieres);
        }
        else if($user->hasRole('chefdep') || request()->session()->get('changeView') == 0){
            // $chefsDep = $user->professeur->chefdep->departement->idDepartement;
            $chefsDep = Chefdep::find($user->id)->departement->idDepartement;
            $filieres = Filiere::where('idDepartement', $chefsDep)->pluck('idFiliere')->toArray();
            return in_array($filiere->idFiliere, $filieres);
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
     * @param  \App\Models\Filiere  $filiere
     * @return mixed
     */
    public function update(User $user, Filiere $filiere)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filiere  $filiere
     * @return mixed
     */
    public function delete(User $user, Filiere $filiere)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filiere  $filiere
     * @return mixed
     */
    public function restore(User $user, Filiere $filiere)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Filiere  $filiere
     * @return mixed
     */
    public function forceDelete(User $user, Filiere $filiere)
    {
        //
    }
}
