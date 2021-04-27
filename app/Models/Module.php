<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Module
 * 
 * @property int $idModule
 * @property string|null $nom
 * @property int|null $vh
 * 
 * @property Collection|Matiere[] $matieres
 * @property Collection|Semestre[] $semestres
 *
 * @package App\Models
 */
class Module extends Model
{
	protected $table = 'module';
	protected $primaryKey = 'idModule';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idModule' => 'int',
		'vh' => 'int'
	];

	protected $fillable = [
		'nom',
		'vh'
	];

	public function matieres()
	{
		return $this->hasMany(Matiere::class, 'idModule');
	}

	public function semestres()
	{
		return $this->hasMany(Semestre::class, 'idModule');
	}
}
