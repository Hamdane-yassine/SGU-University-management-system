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
 * Class Etudiant
 *
 * @property int|null $idPersonne
 * @property int|null $idFiliere
 * @property int $idEtudiant
 * @property string|null $cne
 * @property int|null $apogee
 * @property Carbon|null $anneeDuBaccalaureat
 * @property string|null $cinMere
 * @property string|null $cinPere
 * @property string|null $regimeDeCovertureMedicale
 *
 * @property Personne|null $personne
 * @property Filiere|null $filiere
 * @property Collection|Note[] $notes
 *
 * @package App\Models
 */
class Etudiant extends Model
{
    use HasFactory;
	protected $table = 'etudiant';
	protected $primaryKey = 'idEtudiant';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idPersonne' => 'int',
		'idFiliere' => 'int',
		'idEtudiant' => 'int',
		'apogee' => 'int'
	];

	protected $dates = [
		'anneeDuBaccalaureat'
	];

	protected $fillable = [
		'idPersonne',
		'idFiliere',
		'cne',
		'apogee',
		'anneeDuBaccalaureat',
		'cinMere',
		'cinPere',
		'regimeDeCovertureMedicale'
	];

	public function personne()
	{
		return $this->belongsTo(Personne::class, 'idPersonne');
	}

	public function filiere()
	{
		return $this->belongsTo(Filiere::class, 'idFiliere');
	}

	public function notes()
	{
		return $this->hasMany(Note::class, 'idEtudiant');
	}
} 
