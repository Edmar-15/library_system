<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'notes',
        'user_rating',
    ];

    protected $casts = [
        'user_rating' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'want_to_read' => 'Want to Read',
            'reading' => 'Currently Reading',
            'finished' => 'Finished',
            default => $this->status,
        };
    }

    public function booklists()
    {
        return $this->hasMany(Booklist::class);
    }
}