<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property int|null $idPersonne
 * @property string|null $role
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Personne|null $personne
 * @property Collection|Notification[] $notifications
 * @property Collection|Professeur[] $professeurs
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'idPersonne' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'idPersonne',
		'role',
		'remember_token'
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
