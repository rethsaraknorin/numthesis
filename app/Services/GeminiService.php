<?php

namespace App\Services;

use App\Models\Program;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    /**
     * This function holds all the predefined answers for specific intents.
     */
    private function getPredefinedAnswer(string $intent, string $language): ?string
    {
        $answers = [
            'get_location' => ['kh' => 'សាកលវិទ្យាល័យជាតិគ្រប់គ្រង (NUM) មានទីតាំងនៅផ្លូវ Christopher Howes (៩៦) សង្កាត់វត្តភ្នំ ខណ្ឌដូនពេញ រាជធានីភ្នំពេញ។', 'en' => 'The National University of Management (NUM) is located at Christopher Howes Street (96), Sangkat Wat Phnom, Khan Daun Penh, Phnom Penh.'],
            'get_rector' => ['kh' => 'នាយក​សាលា​បច្ចុប្បន្ន​គឺ​បណ្ឌិត​ ហោ ប៉េង។', 'en' => 'The current Rector is Dr. HOR Peng.'],
            'get_dean_it' => ['kh' => 'ព្រឹទ្ធបុរស​នៃ​មហាវិទ្យាល័យ​អាយធី គឺ​សាស្ត្រាចារ្យ​បណ្ឌិត ឆាយ ផាង។', 'en' => 'The Dean of the IT Faculty is Professor Dr. Chhay Phang.'],
            'get_shift_info' => ['kh' => 'មាន ៣ វេនសម្រាប់ជ្រើសរើស៖ ពេលព្រឹក ពេលរសៀល និងពេលយប់។', 'en' => 'There are 3 shifts for students to choose from: Morning, Afternoon, and Night.'],
            'get_shift_change_policy' => ['kh' => 'អាចដូរវេនការសិក្សាបានក្រោយពេលចេញលទ្ធផល និងមុនពេលចូលរៀនចាប់ផ្ដើមឆមាសថ្មី អំឡុងពេលនិងអាចបង់លុយមុន ហើយដាក់ពាក្យដូរវេន បាន។', 'en' => 'You can change your study shift after the results are out and before the new semester begins. During that time, you can pay first and then apply to change shifts.'],
            'get_document_confirmation' => ['kh' => 'ការបញ្ជាក់ការសិក្សា បញ្ជាក់ពិន្ទុ បញ្ជាក់លិខិតផ្សេងៗបាន នៅការិយាល័យសិក្សា នៅអគា E ជាន់ផ្ទាល់ដី។ រយៈពេលទទួលបានឯកសារ ១អាទិត្យ អាចមកយកបាន លើកលែងថ្ងៃសៅរិ៍ អាទិត្យ។', 'en' => 'For study confirmations, score confirmations, or other letters, you can go to the Academic Affairs Office on the ground floor of Building E. It takes one week to receive the documents, and they can be picked up on any day except Saturday and Sunday.']
        ];
        return $answers[$intent][$language] ?? null;
    }

    /**
     * This function uses the AI to classify the user's intent.
     */
    private function classifyUserIntent(string $userText): string
    {
        $intents = ['get_location', 'get_rector', 'get_dean_it', 'get_shift_info', 'get_shift_change_policy', 'get_document_confirmation', 'ask_about_program', 'general_conversation'];
        $prompt = "Classify the user's question into ONE of the following categories: " . implode(', ', $intents) . ". Respond with ONLY the category name.\n\nUser Question: \"{$userText}\"";
        $responseText = $this->callGeminiApi($prompt, 'gemini-1.5-flash');
        $classifiedIntent = trim(str_replace(['`', '*', '.'], '', $responseText));
        if (in_array($classifiedIntent, $intents)) {
            return $classifiedIntent;
        }
        return 'general_conversation';
    }

    /**
     * This is the main function that handles the user's message.
     */
    public function handleQuery(string $userText, TelegramUser $telegramUser): string
    {
        $language = $telegramUser->language_preference ?? 'kh';
        
        // Step 1: Use the AI to understand the user's intent.
        $intent = $this->classifyUserIntent($userText);

        // Step 2: Check if there's a perfect, predefined answer for this intent.
        $predefinedAnswer = $this->getPredefinedAnswer($intent, $language);
        if ($predefinedAnswer !== null) {
            return $predefinedAnswer; // If yes, return it immediately.
        }

        // Step 3: If no predefined answer, gather dynamic context from the database.
        $context = "";
        $contextFound = false;
        if ($intent === 'ask_about_program' || $intent === 'general_conversation') {
            $context = $this->gatherContext($userText, $language);
            $contextFound = !empty(trim($context));
        }

        // Step 4: Build the final prompt and get the main AI response.
        $prompt = "You are NUM-Bot, a helpful AI assistant for NUM's IT Faculty.\n";
        if ($language === 'kh') {
            $prompt .= "You MUST respond using the Khmer alphabet (អក្សរខ្មែរ).\n\n";
        } else {
            $prompt .= "You must respond ONLY in English.\n\n";
        }

        if ($contextFound) {
            $prompt .= "Base your answer *only* on the following CONTEXT from the university's database:\n";
            $prompt .= "--- DATABASE CONTEXT ---\n{$context}\n------------------------\n\n";
        } else {
            $prompt .= "The database had no specific answer. Use your general knowledge about studying IT.\n";
            $prompt .= "Do not mention you are using general knowledge. Just give a helpful answer.\n\n";
        }
        $prompt .= "Answer this user's question: '{$userText}'";

        return $this->callGeminiApi($prompt);
    }

    /**
     * Gathers context about academic programs. This is the latest, most robust version.
     */
    private function gatherContext(string $userText, string $language): string
    {
        $allPrograms = Program::all();

        // PRIORITY 1: Check for "list all programs" questions with flexible grammar.
        $isListAllQuery = preg_match('/how many program(s)?|what program(s)?|list (of )?program(s)?|all program(s)?|what are they|what they are|ជំនាញអ្វីខ្លះ|មានជំនាញអ្វីខ្លះ/i', $userText);
        if ($isListAllQuery) {
            if ($allPrograms->isEmpty()) {
                return "The database does not currently list any programs.";
            }

            if ($language === 'kh') {
                $programCount = $allPrograms->count();
                $context = "មាន​កម្មវិធី​សិក្សា​ចំនួន {$programCount} នៅ​ក្នុង​មហាវិទ្យាល័យ​ព័ត៌មាន​វិទ្យា។ ខាងក្រោមនេះជាបញ្ជីពេញលេញ៖\n";
                foreach ($allPrograms as $program) {
                    $context .= "- {$program->name} ({$program->code}): \${$program->price_per_year} ក្នុងមួយឆ្នាំ\n";
                }
            } else {
                $context = "The IT Faculty offers " . $allPrograms->count() . " programs. Here is the full list with prices per year:\n";
                foreach ($allPrograms as $program) {
                    $context .= "- {$program->name} ({$program->code}): \${$program->price_per_year}\n";
                }
            }
            return $context;
        }

        // PRIORITY 2: If not listing all, find the best match for a SINGLE program.
        $programsSortedByCode = $allPrograms->sortByDesc(fn($p) => strlen($p->code));
        foreach ($programsSortedByCode as $program) {
            if (preg_match('/\b' . preg_quote($program->code, '/') . '\b/i', $userText)) {
                return $this->buildContextForProgram($program);
            }
        }

        $programsSortedByName = $allPrograms->sortByDesc(fn($p) => strlen($p->name));
        foreach ($programsSortedByName as $program) {
            $stopWords = ['bachelor of', 'master of', 'of', 'and', 'in'];
            $cleanedName = trim(preg_replace('/\s+/', ' ', str_ireplace($stopWords, '', $program->name)));
            if (!empty($cleanedName) && stripos($userText, $cleanedName) !== false) {
                return $this->buildContextForProgram($program);
            }
        }

        return "";
    }

    private function buildContextForProgram(Program $program): string
    {
        $context = "CONTEXT FOR PROGRAM: {$program->name} ({$program->code})\n";
        if ($program->description) {
            $context .= "Program Description: {$program->description}\n";
        }
        if ($program->price_per_year) {
            $context .= "Price per year: \${$program->price_per_year}.\n";
        }
        return $context;
    }

    private function callGeminiApi(string $prompt, string $model = 'gemini-1.5-flash'): string
    {
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            Log::error('GEMINI_API_KEY is not set.');
            return "Sorry, the system is not configured correctly.";
        }
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
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