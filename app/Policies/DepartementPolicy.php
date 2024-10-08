<?php

namespace App\Policies;

use App\Models\Chefdep;
use App\Models\Departement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartementPolicy
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
     * @param  \App\Models\Departement  $departement
     * @return mixed
     */
    public function view(User $user, Departement $departement)
    {
        return $user->professeur->chefdep->departement->idDepartement == $departement->idDepartement;
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
     * @param  \App\Models\Departement  $departement
     * @return mixed
     */
    public function update(User $user, Departement $departement)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Departement  $departement
     * @return mixed
     */
    public function delete(User $user, Departement $departement)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Departement  $departement
     * @return mixed
     */
    public function restore(User $user, Departement $departement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Departement  $departement
     * @return mixed
     */
    public function forceDelete(User $user, Departement $departement)
    {
        //
    }
}
