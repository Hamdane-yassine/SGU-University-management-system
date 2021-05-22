<?php

namespace App\Policies;

use App\Models\Absence;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class AbsencePolicy
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
     * @param  \App\Models\Absence  $absence
     * @return mixed
     */
    public function view(User $user, Absence $absence)
    {

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
     * @param  \App\Models\Absence  $absence
     * @return mixed
     */
    public function update(User $user, Absence $absence)
    {
        // if prof in chef dep
        $chefsDep = Chefdep::find($user->id)->departement->idDepartement;
        $absneteProf = $absence->professeur->idProf;
        return DB::table('prof_departement')->where('idProf',$absneteProf)->where('idDepartement',$chefsdep)->exists();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Absence  $absence
     * @return mixed
     */
    public function delete(User $user, Absence $absence)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Absence  $absence
     * @return mixed
     */
    public function restore(User $user, Absence $absence)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Absence  $absence
     * @return mixed
     */
    public function forceDelete(User $user, Absence $absence)
    {
        //
    }
}
