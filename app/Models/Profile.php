<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
      protected $fillable = ['user_id', 'bio', 'phone', 'address', 'profile_picture'];

    
  public function user()
{
    return $this->belongsTo(User::class);
}

}
