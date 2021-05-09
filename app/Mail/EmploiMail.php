<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmploiMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $userName;
    protected $nomfiliere;
    protected $filePath;
    protected $niveau;
    public function __construct($userName, $nomfiliere,$niveau,  $filePath)
    {
        $this->userName =$userName;
        $this->nomfiliere = $nomfiliere;
        $this->filePath = $filePath;
        $this->niveau = $niveau;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('notification d\'emploi')
        ->view('emails.emploi')
        ->attachFromStorage($this->filePath)
        ->with(['userName' => $this->userName,
                'nomfiliere' => $this->nomfiliere,
                'niveau' => $this->niveau]);

    }
}
