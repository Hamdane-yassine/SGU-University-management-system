<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Anneescolaire
 *
 * @property int $idAnnee
 * @property Carbon|null $annee
 *
 * @property Collection|Semestre[] $semestres
 *
 * @package App\Models
 */
class Anneescolaire extends Model
{
    use HasFactory;
	protected $table = 'anneescolaire';
	protected $primaryKey = 'idAnnee';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idAnnee' => 'int'
	];

	protected $dates = [
		'annee'
	];

	protected $fillable = [
		'annee'
	];

	public function semestres()
	{
		return $this->hasMany(Semestre::class, 'idAnnee');
	}
}
