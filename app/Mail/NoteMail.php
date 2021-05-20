<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Etudiant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $filieresnotes;
    protected Etudiant $etudiant;
    protected $consratt;
    protected $consval;
    public function __construct($filieresnotes , Etudiant $etudiant, $consval,$consratt)
    {
        $this->filieresnotes = $filieresnotes;
        $this->etudiant = $etudiant;
        $this->consval = $consval;
        $this->consratt = $consratt;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('NOTES ET RÉSULTATS : '.$this->filieresnotes[0]['filiere']->nom.' '.$this->filieresnotes[0]['filiere']->niveau)
        ->view('emails.note')
        ->with(['filieresnotes' =>  $this->filieresnotes, 'etudiant' => $this->etudiant, 'consval' => $this->consval, 'consratt' => $this->consratt]);
    }
}
