<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
        'description',
        'book_link',
        'picture'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_year' => 'integer',
    ];

    /**
     * The users that have saved the book.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
