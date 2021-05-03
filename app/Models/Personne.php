<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Personne
 *
 * @property int $idPersonne
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $adressePersonnele
 * @property string|null $cin
 * @property string|null $email
 * @property string|null $tel
 * @property Carbon|null $dateNaissance
 * @property string|null $nationalite
 * @property Carbon|null $lieuNaissance
 * @property string|null $genre
 * @property string|null $emailInstitutionne
 * @property string|null $situationFamiliale
 *
 * @property Collection|Etudiant[] $etudiants
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Personne extends Model
{
    use HasFactory;
	protected $table = 'personne';
	protected $primaryKey = 'idPersonne';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idPersonne' => 'int'
	];

	protected $dates = [
		'dateNaissance',
	];

	protected $fillable = [
		'nom',
		'prenom',
		'adressePersonnele',
		'cin',
		'email',
		'tel',
		'dateNaissance',
		'nationalite',
		'lieuNaissance',
		'genre',
		'emailInstitutionne',
		'situationFamiliale'
	];

	public function etudiant()
	{
		return $this->hasOne(Etudiant::class, 'idPersonne');
	}

	public function user()
	{
		return $this->hasOne(User::class, 'idPersonne');
	}
}
