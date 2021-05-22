<?php

namespace App\Policies;

use App\Models\Chefdep;
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
        return $user->hasRole('master') ? true : ($user->hasRole('chefdep') ? (Chefdep::find($user->id)->professeur->user->id == $evenement->chefdep->professeur->user->id) : false );
        // return true;
    }
    public function create(User $user)
    {
        return $user->hasRole('chefdep');
    }

    public function delete(User $user, Evenement $evenement)
    {
        return auth()->user()->hasRole('master') ? true  : Chefdep::find(auth()->user()->id)->professeur->user->id == Chefdep::find($user->id)->professeur->user->id;
    }

}
