<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Absence
 *
 * @property int|null $idProf
 * @property int $idDepartement
 * @package App\Models
 */

class Prof_departement extends Model
{
    use HasFactory;
    protected $table = 'prof_departement';
	protected $primaryKey = 'idProfDep';
    public $incrementing = false;
	public $timestamps = false;

    protected $fillable = [
        'idProf',
		'idDepartement'
	];

    protected $casts =[
        'idProfDep'=> 'int',
        'idProf'=> 'int',
        'idDepartement'=>'int',
    ];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class , 'idProf');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'idDepartement');
    }
}
