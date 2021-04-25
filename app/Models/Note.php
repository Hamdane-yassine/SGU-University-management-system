<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * 
 * @property int|null $idEtudiant
 * @property int $idNote
 * @property int|null $idMatier
 * @property float|null $controle
 * @property float|null $exam
 * @property float|null $noteGeneral
 * 
 * @property Etudiant|null $etudiant
 * @property Matiere|null $matiere
 *
 * @package App\Models
 */
class Note extends Model
{
	protected $table = 'note';
	protected $primaryKey = 'idNote';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idEtudiant' => 'int',
		'idNote' => 'int',
		'idMatier' => 'int',
		'controle' => 'float',
		'exam' => 'float',
		'noteGeneral' => 'float'
	];

	protected $fillable = [
		'idEtudiant',
		'idMatier',
		'controle',
		'exam',
		'noteGeneral'
	];

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class, 'idEtudiant');
	}

	public function matiere()
	{
		return $this->belongsTo(Matiere::class, 'idMatier');
	}
}
