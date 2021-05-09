<?php

namespace App\Imports;

use App\Models\Personne;
use App\Models\Etudiant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;

class ImportEtudiants implements ToCollection, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $idFiliere;

    public function __construct($idFiliere)
    {
        $this->idFiliere = $idFiliere;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            Personne::create([
                'nom'  => $row[2],
                'prenom'   => $row[3],
                'genre'   => $row[4],
                'dateNaissance'    => Date::excelToDateTimeObject($row[5]),
                'situationFamiliale'  => $row[6],
                'nationalite'   => $row[7],
                'cin'   => $row[9],
                'adressePersonnele'   => $row[12],
                'tel'   => $row[13],
                'emailInstitutionne'   => $row[15],
                'lieuNaissance'   => $row[8]
            ]);
            $lastId = DB::getPdo()->lastInsertId();
            Etudiant::create([
                'idPersonne' => $lastId,
                'apogee'  => $row[0],
                'cne'   => $row[1],
                'email'    => $row[14],
                'anneeDuBaccalaureat'  => $row[16],
                'regimeDeCovertureMedicale'   => $row[17],
                'cinMere'  => $row[11],
                'cinPere'   => $row[10],
                'idFiliere' => $this->idFiliere
            ]);
        }
    }
}
