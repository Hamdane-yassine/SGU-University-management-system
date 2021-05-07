<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AbsenceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $userNam;
    protected $matiereName;
    protected $profName;
    protected $absenceDate;

    public function __construct($profName , $absenceDate, $userName, $matiereName)
    {
        $this->profName = $profName;
        $this->absenceDate = $absenceDate;
        $this->userName = $userName;
        $this->matiereName = $matiereName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('notification d\'absence')
        ->view('emails.absence')
        ->with(['profName' => $this->profName, 'absenceDate' => $this->absenceDate, 'userName' => $this->userNam,
        'matiereName' => $this->matiereName]);
    }
}
