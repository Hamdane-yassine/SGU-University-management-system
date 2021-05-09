<?php

namespace App\Imports;

use App\Models\Personne;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class ImportPersonnes implements ToModel,WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new Personne([
            'nom'  => $row[2],
            'prenom'   => $row[3],
            'genre'   => $row[4],
            'dateNaissance'    => Date::excelToDateTimeObject($row[5]),
            'situationFamiliale'  => $row[6],
            'nationalite'   => $row[7],
            'cin'   => $row[9],
            'adressePersonnele'   => $row[12],
            'tel'   => $row[13],
            'emailInstitutionne'   => $row[14],
            'lieuNaissance'   => $row[8]
        ]);
    }
}
