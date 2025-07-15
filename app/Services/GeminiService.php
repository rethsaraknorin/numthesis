<?php

namespace App\Services;

use App\Models\Program;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    public function handleQuery(string $userText, TelegramUser $telegramUser): string
    {
        $language = $telegramUser->language_preference ?? 'kh';

        $otherFaculties = ['law', 'business', 'economics', 'management', 'tourism', 'arts'];
        foreach ($otherFaculties as $faculty) {
            if (stripos($userText, $faculty) !== false) {
                return $language === 'kh'
                    ? 'សូមអភ័យទោស ខ្ញុំជាជំនួយការ AI សម្រាប់តែដេប៉ាតឺម៉ង់បច្ចេកវិទ្យាព័ត៌មាន (IT) ប៉ុណ្ណោះ។'
                    : "I'm sorry, I am an AI assistant for the Faculty of Information Technology only.";
            }
        }

        $context = $this->gatherContext($userText);
        $contextFound = !empty(trim($context));

        $prompt = "You are NUM-Bot, a friendly and professional AI assistant for the National University of Management's IT Faculty.\n";
        $prompt .= "You must respond ONLY in the '{$language}' language, as that is the user's preference.\n\n";

        if ($contextFound) {
            $prompt .= "Carefully review the following CONTEXT from the university's database. Base your answer *only* on this information.\n";
            $prompt .= "--- DATABASE CONTEXT ---\n{$context}\n------------------------\n\n";
        } else {
            $prompt .= "The university database did not contain a specific answer for the user's question.\n";
            $prompt .= "Therefore, use your general knowledge to answer the user's question helpfully. Frame your answer in the context of a student asking about studying Information Technology at a university.\n";
            $prompt .= "For example, if they ask about preparations, suggest things like focusing on math, logic, and basic programming. If they ask about jobs, suggest roles like developer, analyst, or network administrator.\n";
            $prompt .= "Do not mention that you are using general knowledge. Just give a confident, helpful answer.\n\n";
        }

        $prompt .= "Based on all of the above, answer this user's question: '{$userText}'";

        return $this->callGeminiApi($prompt);
    }

    private function gatherContext(string $userText): string
    {
        $programs = Program::all();
        $isPreparationQuery = preg_match('/prepare|preparation|what should i learn/i', $userText);
        $isCareerQuery = preg_match('/job|career|work|graduate/i', $userText);

        // 1. Check for specific program queries first
        foreach ($programs as $program) {
            if (stripos($userText, $program->code) !== false || stripos($userText, $program->name) !== false) {
                $context = "CONTEXT FOR PROGRAM: {$program->name} ({$program->code})\n";
                if ($program->description) $context .= "Program Description: {$program->description}\n";
                if ($program->preparations) $context .= "What to Prepare: {$program->preparations}\n";
                if ($program->career_opportunities) $context .= "Career Opportunities: {$program->career_opportunities}\n";
                if ($program->price_per_year) $context .= "Price per year: \${$program->price_per_year}.\n";
                return $context; // Found specific info, return immediately
            }
        }

        // 2. If no specific program, check for a general query about preparations or careers
        if ($isCareerQuery || $isPreparationQuery) {
            $generalContext = "";
            foreach ($programs as $program) {
                $programInfo = "";
                if ($isPreparationQuery && !empty($program->preparations)) {
                    $programInfo .= "  - To prepare: {$program->preparations}\n";
                }
                if ($isCareerQuery && !empty($program->career_opportunities)) {
                    $programInfo .= "  - Career options: {$program->career_opportunities}\n";
                }
                if (!empty($programInfo)) {
                    $generalContext .= "For the '{$program->name}' program:\n" . $programInfo;
                }
            }

            if (!empty($generalContext)) {
                return "GENERAL INFORMATION FOR ALL IT PROGRAMS:\n" . $generalContext;
            }
        }
        
        // 3. If we found nothing relevant, return an empty string to trigger general knowledge
        return "";
    }

    private function callGeminiApi(string $prompt): string
    {
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            Log::error('GEMINI_API_KEY is not set.');
            return "Sorry, the system is not configured correctly.";
        }
        
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}";

        try {
            $response = Http::timeout(30)->post($url, ['contents' => [['parts' => [['text' => $prompt]]]]]);
            if ($response->failed()) {
                Log::error('Gemini API request failed', ['status' => $response->status(), 'body' => $response->body()]);
                return "Sorry, I could not process your request at the moment.";
            }
            return data_get($response->json(), 'candidates.0.content.parts.0.text', "I'm sorry, I received an unexpected response from the AI. Please try again.");
        } catch (\Exception $e) {
            Log::error('Exception while calling Gemini API', ['message' => $e->getMessage()]);
            return "Sorry, there was a system error while contacting the AI service.";
        }
    }
}