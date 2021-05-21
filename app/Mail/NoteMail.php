<?php

namespace App\Mail;

use App\Models\env_vars;
use Illuminate\Bus\Queueable;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\services\CalculeNotes;
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
    protected Etudiant $etudiant;
    protected Filiere $filiere;
    public function __construct(Filiere $filiere , Etudiant $etudiant)
    {
        $this->filiere = $filiere;
        $this->etudiant = $etudiant;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $consratt = 6;
        $consval = 12;
        $val = env_vars::where('name', 'ConstantVal')->select('id', 'value')->get();
        $rat = env_vars::where('name', 'ConstantRat')->select('id', 'value')->get();
        if (!$rat->isEmpty() && !$val->isEmpty()) {
            $val = $val->toArray();
            $rat = $rat->toArray();
            $consval = $val[0]['value'];
            $consratt = $rat[0]['value'];
        }
        $filieres = array();
        array_push($filieres, $this->filiere);
        $filieres = array_unique($filieres);
        $filieresnotes = array();
        foreach ($filieres as $filiere) {
            $calc = new CalculeNotes($filiere, $this->etudiant, $consval, $consratt);
            $noteSemestres = array();
            $noteModules = array();
            foreach ($filiere->semestres as $semestre) {
                array_push($noteSemestres, array('idSemestre' => $semestre->idSemestre, 'noteNormal' => $calc->CalcSemestreNormal($semestre->idSemestre), 'noteRatt' => $calc->CalcSemestreRatt($semestre->idSemestre), 'etat' => $calc->EtatSemestre($semestre->idSemestre), 'CheckNormal' => $calc->CheckSemestreNormal($semestre->idSemestre), 'CheckRatt' => $calc->CheckSemestreRatt($semestre->idSemestre), 'etatRatt' => $calc->EtatSemestreRatt($semestre->idSemestre)));
            }
            foreach ($filiere->semestres as $semestre) {
                foreach ($semestre->modules as $module) {
                    array_push($noteModules, array('idModule' => $module->idModule, 'noteNormal' => $calc->CalcModuleNormal($module->idModule), 'noteRatt' => $calc->CalcModuleRatt($module->idModule)));
                }
            }
            array_push($filieresnotes, array(
                "filiere" => $filiere,
                "noteAnne" => $calc->CalcAnneNormal(),
                "noteRatt" => $calc->CalcAnneRatt(),
                "noteSemestres" => $noteSemestres,
                "noteModules" => $noteModules,
                "CheckAnne" => $calc->CheckAnne(),
                "CheckAnneRatt" => $calc->CheckRatt()
            ));
        }
        return $this
        ->subject('NOTES ET RÉSULTATS : '.$filieresnotes[0]['filiere']->nom.' '.$filieresnotes[0]['filiere']->niveau)
        ->view('emails.note')
        ->with(['filieresnotes' =>  $filieresnotes, 'etudiant' => $this->etudiant, 'consval' => $consval, 'consratt' => $consratt]);
    }
}
