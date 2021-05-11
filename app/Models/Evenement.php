<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class Evenement
 *
 * @property int $idEvenement
 * @property int|null $ID_chef
 * @property Carbon|null $Date_even
 * @property string|null $message
 *
 * @property Chefdep|null $chefdep
 *
 * @package App\Models
 */
class Evenement extends Model
{
    use HasFactory;
	protected $table = 'Evenement';
	protected $primaryKey = 'idEvenement';
	public $incrementing = true;
	// public $timestamps = false;

	protected $casts = [
		'idEvenement' => 'int',
		'ID_chef' => 'int'
	];

	protected $dates = [
        'date'
	];

	protected $fillable = [
		'ID_chef',
		'date',
        'titre',
		'html',
        'resume',
        'attachments'
	];

	public function chefdep()
	{
		return $this->belongsTo(Chefdep::class, 'ID_chef');
	}
}
