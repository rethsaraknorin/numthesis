<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'name',
        'description',
        'year',
        'semester',
        'credits',
        'hours',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get all class sessions for this course.
     */
    public function classSessions(): HasMany
    {
        return $this->hasMany(ClassSession::class);
    }
}