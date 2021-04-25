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
 * @property int|null $idSemestre
 * @property int $idModule
 * @property string|null $nom
 * @property int|null $vh
 * 
 * @property Semestre|null $semestre
 * @property Collection|Matiere[] $matieres
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
		'idSemestre' => 'int',
		'idModule' => 'int',
		'vh' => 'int'
	];

	protected $fillable = [
		'idSemestre',
		'nom',
		'vh'
	];

	public function semestre()
	{
		return $this->belongsTo(Semestre::class, 'idSemestre');
	}

	public function matieres()
	{
		return $this->hasMany(Matiere::class, 'idModule');
	}
}
