<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Semestre
 * 
 * @property int|null $idFiliere
 * @property int $idSemestre
 * @property int|null $idAnnee
 * @property string|null $nom
 * 
 * @property Filiere|null $filiere
 * @property Anneescolaire|null $anneescolaire
 * @property Collection|Module[] $modules
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
		'idFiliere' => 'int',
		'idSemestre' => 'int',
		'idAnnee' => 'int'
	];

	protected $fillable = [
		'idFiliere',
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

	public function modules()
	{
		return $this->hasMany(Module::class, 'idSemestre');
	}
}
