<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * 
 * @property int $idNotification
 * @property int|null $idUtilisateur
 * @property string|null $message
 * 
 * @property Utilisateur|null $utilisateur
 *
 * @package App\Models
 */
class Notification extends Model
{
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

	public function utilisateur()
	{
		return $this->belongsTo(Utilisateur::class, 'idUtilisateur');
	}
}
