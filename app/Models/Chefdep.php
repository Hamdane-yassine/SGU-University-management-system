<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Chefdep
 *
 * @property int|null $idDepartement
 * @property int|null $idProf
 * @property int $ID_chef
 *
 * @property Professeur|null $professeur
 * @property Departement|null $departement
 * @property Collection|Evenemnt[] $evenemnts
 *
 * @package App\Models
 */
class Chefdep extends Model
{
    use HasFactory;
	protected $table = 'chefdep';
	protected $primaryKey = 'ID_chef';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idDepartement' => 'int',
		'idProf' => 'int',
		'ID_chef' => 'int'
	];

	protected $fillable = [
		'idDepartement',
		'idProf'
	];

	public function professeur()
	{
		return $this->belongsTo(Professeur::class, 'idProf');
	}

	public function departement()
	{
		return $this->belongsTo(Departement::class, 'idDepartement');
	}
 
	public function evenemnts()
	{
		return $this->hasMany(Evenemnt::class, 'ID_chef');
	}
}
