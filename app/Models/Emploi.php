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
 * @property string $fileName
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
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
		'idEmploi' => 'int',
        'fileName' => 'string'
	];

	protected $fillable = [
        'fileName',
	];

	public function professeur()
	{
		return $this->belongsTo(Professeur::class, 'idProf');
	}

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'idEmploi');
    }
}
