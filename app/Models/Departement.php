<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Departement
 *
 * @property int $idDepartement
 * @property string|null $nom
 *
 * @property Collection|Chefdep[] $chefdeps
 * @property Collection|Filiere[] $filieres
 * @property Collection|Professeur[] $professeurs
 *
 * @package App\Models
 */
class Departement extends Model
{
    use HasFactory;
	protected $table = 'departement';
	protected $primaryKey = 'idDepartement';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idDepartement' => 'int'
	];

	protected $fillable = [
		'nom'
	];

	public function chefdep()
	{
		return $this->hasOne(Chefdep::class, 'idDepartement');
	}

	public function filieres()
	{
		return $this->hasMany(Filiere::class, 'idDepartement');
	}

	public function professeurs()
	{
		return $this->hasMany(Professeur::class, 'idDepartement');
	}
}
