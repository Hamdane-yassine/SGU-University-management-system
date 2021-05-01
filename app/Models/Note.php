<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class Note
 *
 * @property int|null $idEtudiant
 * @property int $idNote
 * @property int|null $idMatiere
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
    use HasFactory;
	protected $table = 'note';
	protected $primaryKey = 'idNote';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idEtudiant' => 'int',
		'idNote' => 'int',
		'idMatiere' => 'int',
		'controle' => 'float',
		'exam' => 'float',
		'noteGeneral' => 'float',
		'Coefcontrole' => 'int',
		'Coefexam' => 'int'
	];

	protected $fillable = [
		'idEtudiant',
		'idMatiere',
		'controle',
		'exam',
		'noteGeneral',
		'Coefcontrole',
		'Coefexam'
	];

	public function etudiant()
	{
		return $this->belongsTo(Etudiant::class, 'idEtudiant');
	}

	public function matiere()
	{
		return $this->belongsTo(Matiere::class, 'idMatiere');
	}
}
