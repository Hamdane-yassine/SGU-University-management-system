<?php

namespace App\Observers;

use App\Models\Evenement;
use App\Models\User;
use App\Notifications\NotifyEvent;
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

    public function created(Evenement $evenement)
    {
        // event(new \App\Notifications\NotifyEvent($user,Evenement::find(2)));
        // User::find(1)->notify(new \App\Notifications\NotifyEvent($user,Evenement::find(1)));
        // broadcast(new \App\Notifications\NotifyEvent($user, $evenement))->toOthers();
        Notification::send(User::find(1),new NotifyEvent());
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
