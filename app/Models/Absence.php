<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Absence
 * 
 * @property int|null $idProf
 * @property int $IdAbsence
 * @property int|null $idMatier
 * @property Carbon|null $dateAbsencee
 * @property Carbon|null $dateRattrapage
 * @property bool|null $etat
 * 
 * @property Professeur|null $professeur
 * @property Matiere|null $matiere
 *
 * @package App\Models
 */
class Absence extends Model
{
	protected $table = 'absence';
	protected $primaryKey = 'IdAbsence';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idProf' => 'int',
		'IdAbsence' => 'int',
		'idMatier' => 'int',
		'etat' => 'bool'
	];

	protected $dates = [
		'dateAbsencee',
		'dateRattrapage'
	];

	protected $fillable = [
		'idProf',
		'idMatier',
		'dateAbsencee',
		'dateRattrapage',
		'etat'
	];

	public function professeur()
	{
		return $this->belongsTo(Professeur::class, 'idProf');
	}

	public function matiere()
	{
		return $this->belongsTo(Matiere::class, 'idMatier');
	}
}
