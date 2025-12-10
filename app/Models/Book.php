<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_picture',
        'rating',
        'total_copies',
        'available_copies',
        'isbn',
        'publisher',
        'publication_year',
        'category',
        'language',
        'pages',
        'status',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'total_copies' => 'integer',
        'available_copies' => 'integer',
        'publication_year' => 'integer',
        'pages' => 'integer',
    ];

    /**
     * Check if book is available for borrowing
     */
    public function isAvailable(): bool
    {
        return $this->available_copies > 0 && $this->status === 'available';
    }

    /**
     * Get the cover picture URL
     */
    public function getCoverPictureUrlAttribute(): ?string
    {
        if ($this->cover_picture) {
            return asset('storage/' . $this->cover_picture);
        }
        return null;
    }

    /**
     * Update availability status based on available copies
     */
    public function updateAvailabilityStatus(): void
    {
        $this->status = $this->available_copies > 0 ? 'available' : 'unavailable';
        $this->save();
    }

    /**
     * Scope to get only available books
     */
    public function scopeAvailable($query)
    {
        return $query->where('available_copies', '>', 0)
                     ->where('status', 'available');
    }

    /**
     * Scope to search books
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%")
              ->orWhere('isbn', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%");
        });
    }

    /**
     * Scope to filter by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to get books by rating
     */
    public function scopeHighRated($query, $minRating = 4.0)
    {
        return $query->where('rating', '>=', $minRating);
    }
}