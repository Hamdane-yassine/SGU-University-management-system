<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $primaryKey = 'idProfile';


    protected $fillable = [
        'imagePath','skype','facebook','linkedin'
    ];

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/JNiNHZYPax0bk1mZWBDuZbvKfghk7OsZRJjsTrXO.png';
        return '/storage/' . $imagePath;
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class,'idUtilisateur');
    }
}
