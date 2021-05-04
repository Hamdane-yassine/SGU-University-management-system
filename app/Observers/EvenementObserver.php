<?php

namespace App\Observers;

use App\Models\Evenement;
use App\Models\User;
use App\Notifications\NotifyEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class EvenementObserver
{
    /**
     * Handle the Evenement "created" event.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return void
     */
    public $afterCommit = true;

    public function created(Evenement $evt)
    {
        // event(new \App\Notifications\NotifyEvent($user,Evenement::find(2)));

        // User::find(1)->notify(new \App\Notifications\NotifyEvent(Auth::user(),$evt));
        // broadcast(new \App\Notifications\NotifyEvent($user, $evenement))->toOthers();
        // echo 'Hello This is what i want  : '.$evenement;
        // Notification::send(User::find([1,2]),new NotifyEvent(User::find(1),$evt));
        // $event = new Evenement($evt->getAttributes());
        $id = Auth::user()->id;
        $current = User::find($id);
        $users = User::where('id','<>',$id)->limit(2)->get();
        if($users->count()>0)
        Notification::send($users,new NotifyEvent($current, $evt));
        else echo "ur alone";

    }

    /**
     * Handle the Evenement "updated" event.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return void
     */
    public function updated(Evenement $evenement)
    {
        //
    }

    /**
     * Handle the Evenement "deleted" event.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return void
     */
    public function deleted(Evenement $evenement)
    {
        //
    }

    /**
     * Handle the Evenement "restored" event.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return void
     */
    public function restored(Evenement $evenement)
    {
        //
    }

    /**
     * Handle the Evenement "force deleted" event.
     *
     * @param  \App\Models\Evenement  $evenement
     * @return void
     */
    public function forceDeleted(Evenement $evenement)
    {
        //
    }
}
