<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class env_vars extends Model
{
    use HasFactory;

    protected $table = 'env_vars';
    protected $casts = [
		'id' => 'int',
        'value' => 'int',
	];

	protected $fillable = [
		'name',
		'value',
	];


}
