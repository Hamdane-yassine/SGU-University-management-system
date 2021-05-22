<?php

namespace App\Policies;

use App\Models\Matiere;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class MatierePolicy
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
     * @param  \App\Models\Matiere  $matiere
     * @return mixed
     */
    public function view(User $user, Matiere $matiere)
    {
        $matieres = DB::table('matiere')
            ->where('idProf', $user->professeur->idProf)
            ->pluck('idMAtiere')->toArray();
        return in_array($matiere->idMatiere, $matieres);
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
     * @param  \App\Models\Matiere  $matiere
     * @return mixed
     */
    public function update(User $user, Matiere $matiere)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Matiere  $matiere
     * @return mixed
     */
    public function delete(User $user, Matiere $matiere)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Matiere  $matiere
     * @return mixed
     */
    public function restore(User $user, Matiere $matiere)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Matiere  $matiere
     * @return mixed
     */
    public function forceDelete(User $user, Matiere $matiere)
    {
        //
    }
}