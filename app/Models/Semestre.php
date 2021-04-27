<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Semestre
 * 
 * @property int $idSemestre
 * @property int|null $idFiliere
 * @property int|null $idModule
 * @property int|null $idAnnee
 * @property string|null $nom
 * 
 * @property Filiere|null $filiere
 * @property Anneescolaire|null $anneescolaire
 * @property Module|null $module
 *
 * @package App\Models
 */
class Semestre extends Model
{
	protected $table = 'semestre';
	protected $primaryKey = 'idSemestre';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idSemestre' => 'int',
		'idFiliere' => 'int',
		'idModule' => 'int',
		'idAnnee' => 'int'
	];

	protected $fillable = [
		'idFiliere',
		'idModule',
		'idAnnee',
		'nom'
	];

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'idFiliere');
	}

	public function anneescolaire()
	{
		return $this->belongsTo(Anneescolaire::class, 'idAnnee');
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'idModule');
	}
}
