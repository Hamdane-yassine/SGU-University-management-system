<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * Class Notification
 *
 * @property int $idNotification
 * @property int|null $idUtilisateur
 * @property string|null $message
 *
 * @property User|null $user
 *
 * @package App\Models
 */
class Notification extends Model
{
    use HasFactory;
	protected $table = 'notification';
	protected $primaryKey = 'idNotification';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idNotification' => 'int',
		'idUtilisateur' => 'int'
	];

	protected $fillable = [
		'idUtilisateur',
		'message'
	]; 

	public function user()
	{
		return $this->belongsTo(User::class, 'idUtilisateur');
	}
}
