<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Emploi
 *
 * @property int|null $idProf
 * @property int $idEmploi
 *
 * @property Professeur|null $professeur
 *
 * @package App\Models
 */
class Emploi extends Model
{
    use HasFactory;
	protected $table = 'emploi';
	protected $primaryKey = 'idEmploi';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idProf' => 'int',
		'idEmploi' => 'int'
	];

	protected $fillable = [
		'idProf'
	];

	public function professeur()
	{
		return $this->belongsTo(Professeur::class, 'idProf');
	}
}
