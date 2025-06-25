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
        'semester',       // Add this line
        'promotion_name',
        'group_name',
        'day_of_week',
        'shift',
        'start_time',
        'end_time',
        'lecturer_name',
        'lecturer_phone',
        'room_number',
    ];

    /**
     * Get the program this class session belongs to.
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the course being taught in this session.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}