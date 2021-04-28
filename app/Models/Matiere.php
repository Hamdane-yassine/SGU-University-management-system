<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class Matiere
 *
 * @property int|null $idProf
 * @property int $idMatier
 * @property int|null $idModule
 * @property string|null $nom
 * @property int|null $vh
 * @property int|null $coeff
 *
 * @property Professeur|null $professeur
 * @property Module|null $module
 * @property Collection|Absence[] $absences
 * @property Collection|Note[] $notes
 *
 * @package App\Models
 */
class Matiere extends Model
{
    use HasFactory;
	protected $table = 'matiere';
	protected $primaryKey = 'idMatier';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idProf' => 'int',
		'idMatier' => 'int',
		'idModule' => 'int',
		'vh' => 'int',
		'coeff' => 'int'
	];

	protected $fillable = [
		'idProf',
		'idModule',
		'nom',
		'vh',
		'coeff'
	];

	public function professeur()
	{
		return $this->belongsTo(Professeur::class, 'idProf');
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'idModule');
	}

	public function absences()
	{
		return $this->hasMany(Absence::class, 'idMatier');
	}

	public function notes()
	{
		return $this->hasMany(Note::class, 'idMatier');
	}
}
