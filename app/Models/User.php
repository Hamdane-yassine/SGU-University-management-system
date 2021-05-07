<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
class User extends Authenticatable
{
	use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'users';

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

	public function professeur()
	{
		return $this->hasOne(Professeur::class, 'idUtilisateur');
	}
    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class,'idProfile');
    }

    public function hasRole(string $role)
    {
        return $this->role == $role ? true : false;
    }
}
