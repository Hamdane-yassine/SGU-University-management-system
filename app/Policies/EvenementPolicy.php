<?php

namespace App\Policies;

use App\Models\Evenement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EvenementPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Evenement $evenement)
    {
        // dd($user->id, $evenement->chefdep->professeur->user->id)
        // dd(auth()->user()->professeur);
        return $user->hasRole('master') || $user->hasRole('chefdep') ||  auth()->user()->id == $evenement->chefdep->professeur->user->id;
        // return true;
    }
    public function create(User $user)
    {
        return $user->hasRole('master') || $user->hasRole('chefdep');
    }


}
