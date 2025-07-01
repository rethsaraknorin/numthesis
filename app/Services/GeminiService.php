<?php

namespace App\Services;

use App\Models\Program;
use App\Models\KeyDate;
use App\Models\ClassSession;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    /**
     * Handles natural language queries by gathering context and calling the Gemini API.
     */
    public function handleQuery(string $userText, \App\Models\TelegramUser $telegramUser): string
    {
        $language = $telegramUser->language_preference;

        $otherFaculties = ['law', 'business', 'economics', 'management', 'tourism', 'arts'];
        foreach ($otherFaculties as $faculty) {
            if (stripos($userText, $faculty) !== false) {
                // THIS IS THE CORRECTED KHMER RESPONSE
                if ($language === 'kh') {
                    return 'សូមអភ័យទោស ខ្ញុំជាជំនួយការ AI សម្រាប់តែដេប៉ាតឺម៉ង់បច្ចេកវិទ្យាព័ត៌មាន (IT) ប៉ុណ្ណោះ។ ខ្ញុំមិនមានទិន្នន័យសម្រាប់ដេប៉ាតឺម៉ង់ផ្សេងទៀតនៅឡើយទេ។';
                }
                // THIS IS THE CORRECTED ENGLISH RESPONSE
                return "I'm sorry, I am an AI assistant for the Faculty of Information Technology only. I don't have data for other faculties at this time.";
            }
        }

        $context = $this->gatherContext($userText, $telegramUser);
        $contextFound = !empty(trim($context));

        // Build the prompt conditionally
        $prompt = "You are a helpful and friendly assistant for the National University of Management (NUM)'s Faculty of Information Technology. Today's date is " . now()->format('F j, Y') . ".\n";
        $prompt .= "The user is communicating in {$language}. Please respond ONLY in the {$language} language.\n";

        if ($contextFound) {
            $prompt .= "Your primary goal is to answer the user's question based *only* on the specific context I provide below. The Faculty of IT has 4 main programs.\n\n";
            $prompt .= "CONTEXT FROM DATABASE:\n---\n{$context}\n---\n\n";
        } else {
            $prompt .= "The university database did not have specific information for the user's question. Please use your general knowledge to answer the user's question helpfully, keeping in mind you represent the IT Faculty. If you do not know the answer, say that you are an AI assistant for NUM's IT Faculty and do not have that specific information.\n\n";
        }
        
        $prompt .= "USER QUESTION: {$userText}";

        return $this->callGeminiApi($prompt);
    }

    /**
     * Gathers all relevant information from the database based on the user's text.
     */
    private function gatherContext(string $userText, \App\Models\TelegramUser $telegramUser): string
    {
        $context = "";

        // Logic for program-related queries
        $programs = Program::all();
        $isGeneralProgramQuery = stripos($userText, 'how many program') !== false ||
                                 stripos($userText, 'list all program') !== false ||
                                 (stripos($userText, 'program') !== false && stripos($userText, 'IT faculty') !== false);

        if ($isGeneralProgramQuery) {
            $context .= "CONTEXT ON ALL ACADEMIC PROGRAMS IN THE IT FACULTY:\n";
            $context .= "The IT Faculty has a total of " . $programs->count() . " academic programs.\n";
            $context .= "They are: ";
            foreach ($programs as $program) {
                $context .= "{$program->name} ({$program->code}), ";
            }
            $context = rtrim($context, ', ') . ".\n";
        } else {
            foreach ($programs as $program) {
                if (stripos($userText, $program->code) !== false || stripos($userText, $program->name) !== false) {
                    $context .= "CONTEXT ON A SPECIFIC PROGRAM:\n";
                    $context .= "Program Name: {$program->name} ({$program->code}).\n";
                    if ($program->description) $context .= "Description: {$program->description}.\n";
                    if ($program->price_per_year) $context .= "Price per year: \${$program->price_per_year}.\n";
                    if ($program->price_per_semester) $context .= "Price per semester: \${$program->price_per_semester}.\n";
                    break;
                }
            }
        }
        
        return $context;
    }

    /**
     * Calls the Gemini API with the constructed prompt.
     */
    private function callGeminiApi(string $prompt): string
    {
        $apiKey = env('GEMINI_API_KEY');
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}";

        try {
            $response = Http::post($url, ['contents' => [['parts' => [['text' => $prompt]]]]]);
            if ($response->failed()) {
                Log::error('Gemini API request failed', ['body' => $response->body()]);
                return "Sorry, I could not process your request at the moment.";
            }
            return $response->json()['candidates'][0]['content']['parts'][0]['text'];
        } catch (\Exception $e) {
            Log::error('Exception caught while calling Gemini API', ['message' => $e->getMessage()]);
            return "Sorry, there was a system error.";
        }
    }
}