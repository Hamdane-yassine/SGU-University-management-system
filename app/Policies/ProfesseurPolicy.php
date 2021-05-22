<?php

namespace App\Policies;

use App\Models\Chefdep;
use App\Models\Prof_departement;
use App\Models\Professeur;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfesseurPolicy
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
     * @param  \App\Models\Professeur  $professeur
     * @return mixed
     */
    public function view(User $user, Professeur $professeur)
    {
        $chefsDep = Chefdep::find($user->id)->departement->idDepartement;
        $profs = Prof_departement::where('idDepartement', $chefsDep)->pluck('idProf')->toArray();
        return in_array($professeur->idProf, $profs);
    }

    /**
     pro$professeur Determine idProf  the user can create models.
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
     * @param  \App\Models\Professeur  $professeur
     * @return mixed
     */
    public function update(User $user, Professeur $professeur)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professeur  $professeur
     * @return mixed
     */
    public function delete(User $user, Professeur $professeur)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professeur  $professeur
     * @return mixed
     */
    public function restore(User $user, Professeur $professeur)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Professeur  $professeur
     * @return mixed
     */
    public function forceDelete(User $user, Professeur $professeur)
    {
        //
    }
}
