<?php

namespace App\Observers;

use App\Models\Evenement;

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
