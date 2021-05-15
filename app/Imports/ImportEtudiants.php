<?php

namespace App\Imports;

use App\Models\Personne;
use App\Models\Etudiant;
use App\Notifications\ImportHasFailedNotification;//class of notification
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;

class ImportEtudiants implements ToCollection, WithStartRow ,WithChunkReading,ShouldQueue,WithEvents
{
    use Importable;

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
    public function chunkSize(): int
    {
        return 500;
    }
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.0' => 'required|unique:etudiant,apogee',
            '*.1' => 'required|unique:etudiant,cne',
            '*.2' => 'required',
            '*.3' => 'required',
            '*.4' => 'required',
            '*.5' => 'required',
            '*.6' => 'required',
            '*.7' => 'required',
            '*.8' => 'required',
            '*.9' => 'required|unique:personne,cin',
            '*.10' => 'required',
            '*.11' => 'required',
            '*.12' => 'required',
            '*.13' => 'required',
            '*.14' => 'required|unique:etudiant,email',
            '*.15' => 'required|unique:personne,emailInstitutionne',
            '*.16' => 'required',
            '*.17' => 'required',

        ])->validate();
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
    public function registerEvents(): array
    {
        return [
        //     ImportFailed::class => function(ImportFailed $event) {  // notify the user by ImportFailed
        //         $this->importedBy->notify(new ImportHasFailedNotification);
        //     },
        ];
    }
}
