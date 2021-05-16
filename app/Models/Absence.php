<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Absence
 *
 * @property int|null $idProf
 * @property int $IdAbsence
 * @property int|null $idMatiere
 * @property Carbon|null $dateAbsencee
 * @property Carbon|null $dateRattrapage
 * @property bool|null $etat
 * @property string $salle
 * @property Professeur|null $professeur
 * @property Matiere|null $matiere
 *
 * @package App\Models
 */
class Absence extends Model
{
    use HasFactory;
	protected $table = 'absence';
	protected $primaryKey = 'IdAbsence';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idProf' => 'int',
		'IdAbsence' => 'int',
		'idMatiere' => 'int',
		'dateAbsence' => 'datetime'
	];

	protected $dates = [
		'dateAbsence'
	];

	protected $fillable = [
		'IdAbsence',
		'idProf',
		'idMatiere',
		'dateAbsence',
		'dateRattrapage',
		'etat'
	];

	public function professeur()
	{
		return $this->belongsTo(Professeur::class, 'idProf');
	}

	public function matiere()
	{
		return $this->belongsTo(Matiere::class, 'idMatiere');
	}

}
