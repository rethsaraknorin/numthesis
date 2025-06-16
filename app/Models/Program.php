<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'price_per_year', // Add this line
        'price_per_semester', // Add this line
    ];

    /**
     * Get the courses for the academic program.
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class)->orderBy('year')->orderBy('semester');
    }
}