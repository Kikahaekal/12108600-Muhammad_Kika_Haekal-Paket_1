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
        'cover',
        'publisher',
        'publication_year',
        'stock'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('borrow_date', 'return_date', 'status', 'due_date');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
