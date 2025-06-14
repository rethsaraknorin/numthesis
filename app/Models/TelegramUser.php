<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'telegram_id',
        'last_login',
    ];

    // RELATIONSHIP: TelegramUser belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
