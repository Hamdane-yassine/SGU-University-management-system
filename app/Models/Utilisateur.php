<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Utilisateur
 * 
 * @property int|null $idPersonne
 * @property int $idUtilisateur
 * @property string|null $nomUtilisateur
 * @property string|null $motDePass
 * @property string|null $role
 * 
 * @property Personne|null $personne
 * @property Collection|Notification[] $notifications
 * @property Collection|Professeur[] $professeurs
 *
 * @package App\Models
 */
class Utilisateur extends Model
{
	protected $table = 'utilisateur';
	protected $primaryKey = 'idUtilisateur';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idPersonne' => 'int',
		'idUtilisateur' => 'int'
	];

	protected $fillable = [
		'idPersonne',
		'nomUtilisateur',
		'motDePass',
		'role'
	];

	public function personne()
	{
		return $this->belongsTo(Personne::class, 'idPersonne');
	}

	public function notifications()
	{
		return $this->hasMany(Notification::class, 'idUtilisateur');
	}

	public function professeurs()
	{
		return $this->hasMany(Professeur::class, 'idUtilisateur');
	}
}
