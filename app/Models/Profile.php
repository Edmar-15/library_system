<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
        protected $fillable = ['user_id', 'profile_picture', 'bio', 'phone', 'address'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
