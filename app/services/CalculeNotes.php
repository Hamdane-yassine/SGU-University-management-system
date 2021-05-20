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
    private  $consratt;
    private  $consval;
    public function __construct(Filiere $filiere, Etudiant $etudiant,$consval,$consratt)
    {
        $this->filiere = $filiere;
        $this->etudiant = $etudiant;
        $this->consratt=$consratt;
        $this->consval=$consval;
    }

    public function CalcModuleNormal($idModule)
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
        if (count($this->etudiant->notes) == 0) {
            return -1;
        } else {
            return round($noteModule, 2);
        }
    }

    public function CalcSemestreNormal($idSemestre)
    {
        $semestre = Semestre::find($idSemestre);
        $noteSemestre = 0;
        foreach ($semestre->modules as $module) {
            $noteSemestre += $this->CalcModuleNormal($module->idModule);
        }
        if ($noteSemestre < 0 || count($semestre->modules) == 0) {
            return -1;
        } else {
            $noteSemestre = $noteSemestre / count($semestre->modules);
            return round($noteSemestre, 2);
        }
    }

    public function CalcAnneNormal()
    {
        $noteAnne = 0;
        foreach ($this->filiere->semestres as $semestre) {
            $noteAnne += $this->CalcSemestreNormal($semestre->idSemestre);
        }
        if ($noteAnne < 0 || count($this->filiere->semestres) == 0) {
            return -1;
        } else {
            $noteAnne = $noteAnne / count($this->filiere->semestres);
            return round($noteAnne, 2);
        }
    }

    public function CalcModuleRatt($idModule)
    {
        $module = Module::find($idModule);
        $noteModule = 0;
        foreach ($module->matieres as $matiere) {
            foreach ($this->etudiant->notes as $note) {
                if ($note->matiere->idMatiere == $matiere->idMatiere) {
                    if ($note->noteRatt != null) {
                        $noteModule += $note->noteRatt * ($matiere->coeff / 100);
                    } else {
                        $noteModule += $note->noteGeneral * ($matiere->coeff / 100);
                    }
                }
            }
        }
        if (count($this->etudiant->notes) == 0) {
            return -1;
        } else {
            return round($noteModule, 2);
        }
    }

    public function CalcSemestreRatt($idSemestre)
    {
        $semestre = Semestre::find($idSemestre);
        $noteSemestre = 0;
        foreach ($semestre->modules as $module) {
            $noteSemestre += $this->CalcModuleRatt($module->idModule);
        }
        if ($noteSemestre < 0 || count($semestre->modules) == 0) {
            return -1;
        } else {
            $noteSemestre = $noteSemestre / count($semestre->modules);
            return round($noteSemestre, 2);
        }
    }

    public function CalcAnneRatt()
    {
        $noteAnne = 0;
        foreach ($this->filiere->semestres as $semestre) {
            $noteAnne += $this->CalcSemestreRatt($semestre->idSemestre);
        }
        if ($noteAnne < 0 || count($this->filiere->semestres) == 0) {
            return -1;
        } else {
            $noteAnne = $noteAnne / count($this->filiere->semestres);
            return round($noteAnne, 2);
        }
    }
    public function EtatSemestre($idSemestre)
    {
        $semestre = Semestre::find($idSemestre);
        $noteSemestre = 0;
        $check = 0;
        foreach ($semestre->modules as $module) {
            if ($this->CalcModuleNormal($module->idModule) < $this->consval) {
                $check++;
            }
        }
        if ($check == 0) {
            return "Validé";
        } else {
            return "Non Validé";
        }
    }

    public function EtatSemestreRatt($idSemestre)
    {
        $semestre = Semestre::find($idSemestre);
        $noteSemestre = 0;
        $check = 0;
        foreach ($semestre->modules as $module) {
            if ($this->CalcModuleRatt($module->idModule) < $this->consval) {
                $check++;
            }
        }
        if ($check == 0) {
            return "Validé";
        } else {
            return "Non Validé";
        }
    }

    public function CheckSemestreNormal($idSemestre)
    {
        $semestre = Semestre::find($idSemestre);
        $check = true;
        $countMatieres = 0;
        $AnotherCount = 0;
        foreach ($semestre->modules as $module) {
            $countMatieres += count($module->matieres);
            foreach ($module->matieres as $matiere) {
                foreach ($this->etudiant->notes as $note) {
                    if ($note->matiere->idMatiere == $matiere->idMatiere) {
                        $AnotherCount++;
                    }
                }
            }
        }
        if ($countMatieres ==  $AnotherCount) {
            foreach ($semestre->modules as $module) {
                foreach ($module->matieres as $matiere) {
                    foreach ($this->etudiant->notes as $note) {
                        if ($note->matiere->idMatiere == $matiere->idMatiere && $note->noteGeneral == null) {
                            $check = false;
                            break;
                        }
                    }
                }
            }
        } else {
            $check = false;
        }
        return $check;
    }

    public function CheckSemestreRatt($idSemestre)
    {
        $semestre = Semestre::find($idSemestre);
        $check = false;
        if ($this->CheckSemestreNormal($idSemestre)) {
            foreach ($semestre->modules as $module) {
                if ($this->CalcModuleNormal($module->idModule) >= $this->consratt && $this->CalcModuleNormal($module->idModule) < $this->consval) {
                    $check = true;
                    foreach ($module->matieres as $matiere) {
                        foreach ($this->etudiant->notes as $note) {
                            if ($note->matiere->idMatiere == $matiere->idMatiere && $note->noteGeneral < $this->consval && $note->noteRatt == null) {
                                $check = false;
                                break;
                            }
                        }
                    }
                }
            }
        }
        return $check;
    }

    public function CheckAnne()
    {
        $check = true;
        foreach ($this->filiere->semestres as $semestre) {
            if (!$this->CheckSemestreNormal($semestre->idSemestre) || $this->CalcSemestreNormal($semestre->idSemestre) < 0) {
                $check = false;
            }
        }
        return $check;
    }

    public function CheckRatt()
    {
        $check = true;
        foreach ($this->filiere->semestres as $semestre) {
            if ($this->EtatSemestre($semestre->idSemestre) == "Non Validé") {
                $tst=0;
                foreach($semestre->modules  as $module)
                {
                    if($this->CalcModuleNormal($module->idModule) >=$this->consratt && $this->CalcModuleNormal($module->idModule) < $this->consval)
                    {
                        $tst=1;
                    }
                }
                if ($tst==1 && $this->CheckSemestreRatt($semestre->idSemestre) == false) {
                    $check = false;
                }
            }
        }
        $countcheck=0;
        $countModules=0;
        foreach ($this->filiere->semestres as $semestre) {
            $countModules+=count($semestre->modules);
            foreach ($semestre->modules as $module) {
                if ($this->CalcModuleNormal($module->idModule) >= $this->consval) {
                    $countcheck++;
                }
            }        
        }
        if ($this->CheckAnne()==false || $countcheck==$countModules) {
            $check = false;
        }
        return $check;
    }
}
