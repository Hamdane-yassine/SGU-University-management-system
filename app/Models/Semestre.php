<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;
	protected $table = 'semestre';
	protected $primaryKey = 'idSemestre';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idAnnee' => 'int'
	];

	protected $fillable = [
		'idAnnee',
		'nom'
	];

	public function anneescolaire()
	{
		return $this->belongsTo(Anneescolaire::class, 'idAnnee');
	}

	public function modules()
	{
		return $this->hasMany(Module::class, 'idSemestre');
	}
}
