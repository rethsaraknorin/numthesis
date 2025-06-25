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
        'price_per_year',
        'price_per_semester',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class)->orderBy('year')->orderBy('semester');
    }

    /**
     * Get all class sessions for the academic program.
     */
    public function classSessions(): HasMany
    {
        return $this->hasMany(ClassSession::class);
    }
}