<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class Filiere
 *
 * @property int|null $idDepartement
 * @property int|null $idEmploi
 * @property int $idFiliere
 * @property string|null $nom
 * @property string|null $shortcut
 * @property string|null $diplome
 * @property int|null $niveau
 *
 * @property Departement|null $departement
 * @property Collection|Etudiant[] $etudiants
 * @property Collection|Semestre[] $semestres
 *
 * @package App\Models
 */
class Filiere extends Model
{
    use HasFactory;
	protected $table = 'filiere';
	protected $primaryKey = 'idFiliere';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idDepartement' => 'int',
		'idFiliere' => 'int',
		'niveau' => 'int'
	];

	protected $fillable = [
		'idDepartement',
		'nom',
		'shortcut',
		'diplome',
		'niveau',
        'idEmploi'
	];

	public function departement()
	{
		return $this->belongsTo(Departement::class, 'idDepartement');
	}

	public function etudiants()
	{
		return $this->hasMany(Etudiant::class, 'idFiliere');
	}

	public function semestres()
	{
		return $this->hasMany(Semestre::class, 'idFiliere');
	}

	public function modules()
	{
		return $this->hasMany(Module::class, 'idFiliere');
	}

    public function emploi()
    {
        return $this->hasOne(Emploi::class, 'idEmploi');
    }
}
