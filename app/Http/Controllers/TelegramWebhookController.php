<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramWebhookController extends Controller
{
    private GeminiService $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function handle(Request $request, Api $telegram)
    {
        $update = $telegram->getWebhookUpdate();
        // Log::info('Telegram Update:', $update->toArray()); // <-- This is now safely commented out

        if ($update->isType('callback_query')) {
            $this->handleCallbackQuery($telegram, $update->getCallbackQuery());
            return response()->json(['status' => 'ok']);
        }

        if ($message = $update->getMessage()) {
            $chatId = $message->getChat()->getId();
            $text = $message->getText();

            $telegramUser = TelegramUser::firstOrCreate(
                ['telegram_id' => $chatId],
                ['language_preference' => 'kh']
            );
            App::setLocale($telegramUser->language_preference);

            if ($text) {
                if ($text === '/start') {
                    $this->handleStartCommand($telegram, $chatId);
                } elseif ($text === '/language') {
                    $this->handleLanguageCommand($telegram, $chatId);
                } else {
                    $telegram->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);

                    // Use our new service to get the response!
                    $response = $this->geminiService->handleQuery($text, $telegramUser);

                    $telegram->sendMessage(['chat_id' => $chatId, 'text' => $response, 'parse_mode' => 'Markdown']);
                }
            }
        }
        return response()->json(['status' => 'ok']);
    }

    private function handleCallbackQuery(Api $telegram, $callbackQuery): void
    {
        $chatId = $callbackQuery->getMessage()->getChat()->getId();
        $callbackData = $callbackQuery->getData();
        $telegram->answerCallbackQuery(['callback_query_id' => $callbackQuery->getId()]);
        if (strpos($callbackData, 'set_language:') === 0) {
            $lang = explode(':', $callbackData)[1];
            $telegramUser = TelegramUser::where('telegram_id', $chatId)->first();
            if ($telegramUser) {
                $telegramUser->language_preference = $lang;
                $telegramUser->save();
                App::setLocale($lang);
            }
            $replyText = ($lang === 'en') ? 'Language set to English.' : 'ភាសាត្រូវបានកំណត់ទៅជាភាសាខ្មែរ។';
            $telegram->sendMessage(['chat_id' => $chatId, 'text' => $replyText]);
        }
    }

    private function handleStartCommand(Api $telegram, int $chatId): void
    {
        $welcomeMessage = __('welcome_title_prefix') . "\n\n" . __('welcome_subtitle');
        $telegram->sendMessage(['chat_id' => $chatId, 'text' => $welcomeMessage]);
        $this->handleLanguageCommand($telegram, $chatId);
    }

    private function handleLanguageCommand(Api $telegram, int $chatId): void
    {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => 'Please choose your language: / សូមជ្រើសរើសភាសារបស់អ្នក៖',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => 'English', 'callback_data' => 'set_language:en'], ['text' => 'ភាសាខ្មែរ', 'callback_data' => 'set_language:kh']]
                ]
            ])
        ]);
    }
}
