<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Models\User;
use Illuminate\Http\Request;

class TelegramUserController extends Controller
{
    /**
     * Link Telegram user to website account.
     */
    public function loginOrRegister(Request $request)
    {
        $request->validate([
            'telegram_id' => 'required|string',
            'email' => 'required|email',
        ]);

        // Find website user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => '❌ User not found. Please register on the website.'], 404);
        }

        // Link or update Telegram user
        $telegramUser = TelegramUser::updateOrCreate(
            ['telegram_id' => $request->telegram_id],
            [
                'user_id' => $user->id,
                'last_login' => now()
            ]
        );

        return response()->json(['message' => '✅ Login successful!']);
    }
}
