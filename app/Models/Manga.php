<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover',
        'description',
        'category_id',
        'rate',
        'author',
        'release_date',
        'artist',
        'state',
        'slug'
    ];

    protected $casts = [
        // 'category_id' => 'array'
    ];
}