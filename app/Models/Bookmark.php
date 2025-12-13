<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
      protected $fillable = ['user_id', 'book_id', 'last_page'];
      
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
