<?php

namespace App\services;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Module;
use App\Models\Semestre;
use App\Models\Matiere;

class CalculeNotes
{
    private Filiere $filiere;
    private Etudiant $etudiant;
    public function __construct(Filiere $filiere, Etudiant $etudiant)
    {
        $this->filiere = $filiere;
        $this->etudiant = $etudiant;
    }

    public function CalcModule($idModule)
    {
        $module = Module::find($idModule);
        $noteModule = 0;
        foreach ($module->matieres as $matiere) {
            foreach ($this->etudiant->notes as $note) {
                if ($note->matiere->idMatiere == $matiere->idMatiere) {
                    $noteModule += $note->noteGeneral * ($matiere->coeff / 100);
                }
            }
        }
        if(count($this->etudiant->notes)==0)
        {
            return -1;
        }else{
            return round($noteModule,2);
        }
    }

    public function CalcSemestre($idSemestre)
    {
        $semestre = Semestre::find($idSemestre);
        $noteSemestre = 0;
        foreach($semestre->modules as $module)
        {
            $noteSemestre+=$this->CalcModule($module->idModule);
        }
        $noteSemestre=$noteSemestre/count($semestre->modules);
        if($noteSemestre<0)
        {
            return -1;
        }else{
            return round($noteSemestre,2);
        }
    }

    public function CalcAnne()
    {
        $noteAnne=0;
        foreach($this->filiere->semestres as $semestre)
        {
            $noteAnne += $this->CalcSemestre($semestre->idSemestre);
        }
        $noteAnne = $noteAnne/count($this->filiere->semestres);
        if($noteAnne < 0)
        {
            return -1;
        }else{
            return round($noteAnne,2);
        }
    }
}
