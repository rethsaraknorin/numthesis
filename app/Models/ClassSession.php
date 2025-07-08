<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassSession extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'program_id',
        'course_id',
        'year',
        'semester',
        'promotion_name',
        'group_name',    
        'day_of_week',
        'start_time',
        'end_time',
        'lecturer_name',
        'room_number',
        'shift',        
        'lecturer_phone', // ADDED
    ];

    /**
     * Get the course that this session belongs to.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the program that this session belongs to.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
}
