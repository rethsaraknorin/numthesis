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
        'language_preference',
        'last_login',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
