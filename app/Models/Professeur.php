<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Professeur
 * 
 * @property int|null $idUtilisateur
 * @property int|null $idDepartement
 * @property int $idProf
 * @property string|null $specialite
 * @property string|null $echellon
 * 
 * @property User|null $user
 * @property Departement|null $departement
 * @property Collection|Absence[] $absences
 * @property Collection|Chefdep[] $chefdeps
 * @property Collection|Emploi[] $emplois
 * @property Collection|Matiere[] $matieres
 *
 * @package App\Models
 */
class Professeur extends Model
{
	protected $table = 'professeur';
	protected $primaryKey = 'idProf';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUtilisateur' => 'int',
		'idDepartement' => 'int',
		'idProf' => 'int'
	];

	protected $fillable = [
		'idUtilisateur',
		'idDepartement',
		'specialite',
		'echellon'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idUtilisateur');
	}

	public function departement()
	{
		return $this->belongsTo(Departement::class, 'idDepartement');
	}

	public function absences()
	{
		return $this->hasMany(Absence::class, 'idProf');
	}

	public function chefdeps()
	{
		return $this->hasMany(Chefdep::class, 'idProf');
	}

	public function emplois()
	{
		return $this->hasMany(Emploi::class, 'idProf');
	}

	public function matieres()
	{
		return $this->hasMany(Matiere::class, 'idProf');
	}
}