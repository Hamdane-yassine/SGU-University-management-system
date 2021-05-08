<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $Username;
    protected $email;
    protected $password;

     public function __construct($Username , $email, $password)
    {
        $this->Username = $Username;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('Création du compte')
        ->view('emails.compte')
        ->with(['Username' => $this->Username, 'email' => $this->email, 'password' => $this->password]);
    }
}
