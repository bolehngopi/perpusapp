<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'title',
        'author',
        'publisher',
        'publication_year',
        'genre',
        'description',
        'total_copies',
        'available_copies',
        'location',
        'language',
        'is_reference_only'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function isAvailableForBorrowing()
    {
        return $this->available_copies > 0 && !$this->is_reference_only;
    }
    
}
