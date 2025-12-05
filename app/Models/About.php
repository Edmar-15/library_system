<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'mission',
        'vision',
        'features',
        'developer_name',
        'developer_role',
        'developer_email',
        'image',
        'contact_email',
        'contact_phone',
    ];

    // Cast developer_name to array when retrieving from database
    protected $casts = [
        'developer_name' => 'array',
    ];
}