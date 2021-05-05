<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class Professeur
 *
 * @property int|null $idUtilisateur
 * @property int|null $idDepartement
 * @property int|null $idEmploi
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
    use HasFactory;
	protected $table = 'professeur';
	protected $primaryKey = 'idProf';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idUtilisateur' => 'int',
		'idProf' => 'int',
		'idEmploi' => 'int'
	];

	protected $fillable = [
		'idUtilisateur',
		'specialite',
		'echellon'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idUtilisateur');
	}

	public function prof_departements()
	{
		return $this->hasMany(Prof_departement::class, 'idProf');
	}

	public function absences()
	{
		return $this->hasMany(Absence::class, 'idProf');
	}

	public function chefdep()
	{
		return $this->hasOne(Chefdep::class, 'idProf');
	}

	public function emploi()
	{
		return $this->hasOne(Emploi::class, 'idEmploi');
	}

	public function matieres()
	{
		return $this->hasMany(Matiere::class, 'idProf');
	}
}
