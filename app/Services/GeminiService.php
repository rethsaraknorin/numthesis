<?php

namespace App\Services;

use App\Models\Program;
use App\Models\TelegramUser;
use Illuminate\Http\Client\ConnectionException;
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
        
        $intent = $this->classifyUserIntent($userText);

        $predefinedAnswer = $this->getPredefinedAnswer($intent, $language);
        if ($predefinedAnswer !== null) {
            return $predefinedAnswer;
        }

        $context = "";
        $contextFound = false;

        $contextResult = $this->gatherContext($userText, $language);

        if ($contextResult['type'] === 'direct') {
            return $contextResult['content'];
        }

        $context = $contextResult['content'];
        $contextFound = !empty(trim($context));

        $prompt = "You are NUM-Bot, a helpful AI assistant for NUM's IT Faculty.\n";
        
        if ($language === 'kh') {
            $prompt .= "You MUST respond using ONLY the Khmer alphabet (អក្សរខ្មែរ). Do NOT include any English romanization or transliteration of the Khmer words in your response.\n\n";
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
     * Gathers context about academic programs.
     * NOW RETURNS an array with a 'type' to indicate if it's a direct answer or just context.
     */
    private function gatherContext(string $userText, string $language): array
    {
        $allPrograms = Program::all();

        $isListAllQuery = preg_match('/how many program(s)?|what program(s)?|list (of )?program(s)?|all program(s)?|what are they|what they are|ជំនាញអ្វីខ្លះ|មានជំនាញអ្វីខ្លះ/i', $userText);
        if ($isListAllQuery) {
            if ($allPrograms->isEmpty()) {
                $content = $language === 'kh' ? 'មិនមានកម្មវិធីសិក្សាទេ' : 'There are no programs available.';
                return ['type' => 'direct', 'content' => $content];
            }

            $programCount = $allPrograms->count();
            
            if ($language === 'kh') {
                $content = "មានកម្មវិធីសិក្សាសរុបចំនួន ៤ នៅមហាវិទ្យាល័យព័ត៌មានវិទ្យា។ កម្មវិធីទាំងនោះរួមមានតម្លៃសិក្សាដូចខាងក្រោម៖\n\n";
                foreach ($allPrograms as $program) {
                    $content .= "- {$program->name} ({$program->code}): \${$program->price_per_year} ក្នុងមួយឆ្នាំ\n";
                }
            } else {
                $content = "There are a total of {$programCount} programs in the IT Faculty. Here is the full list with prices per year:\n\n";
                foreach ($allPrograms as $program) {
                    $content .= "- {$program->name} ({$program->code}): \${$program->price_per_year}\n";
                }
            }
            return ['type' => 'direct', 'content' => $content];
        }

        $programsSortedByCode = $allPrograms->sortByDesc(fn($p) => strlen($p->code));
        foreach ($programsSortedByCode as $program) {
            if (preg_match('/\b' . preg_quote($program->code, '/') . '\b/i', $userText)) {
                return ['type' => 'context', 'content' => $this->buildContextForProgram($program)];
            }
        }

        $programsSortedByName = $allPrograms->sortByDesc(fn($p) => strlen($p->name));
        foreach ($programsSortedByName as $program) {
            $stopWords = ['bachelor of', 'master of', 'of', 'and', 'in'];
            $cleanedName = trim(preg_replace('/\s+/', ' ', str_ireplace($stopWords, '', $program->name)));
            if (!empty($cleanedName) && stripos($userText, $cleanedName) !== false) {
                return ['type' => 'context', 'content' => $this->buildContextForProgram($program)];
            }
        }

        return ['type' => 'context', 'content' => ''];
    }

    private function buildContextForProgram(Program $program): string
    {
        $context = "CONTEXT FOR PROGRAM: {$program->name} ({$program->code})\n";
        $context .= "Program Level: Bachelor's Degree.\n";
        $context .= "Duration: 4 years.\n";
        
        if ($program->description) {
            $context .= "Program Description: {$program->description}\n";
        }
        if ($program->price_per_year) {
            $context .= "Price per year: \${$program->price_per_year}.\n";
        }
        if ($program->price_per_semester) {
            $context .= "Price per semester: \${$program->price_per_semester}.\n";
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
                if ($response->status() === 503) {
                    return "I'm experiencing high traffic right now. Please try again in a moment.";
                }
                return "Sorry, I could not process your request at the moment.";
            }

            return data_get($response->json(), 'candidates.0.content.parts.0.text', "I'm sorry, I received an unexpected response from the AI. Please try again.");
        
        } catch (ConnectionException $e) {
            Log::error('Gemini API connection timed out', ['message' => $e->getMessage()]);
            return "I'm having trouble connecting to my brain right now. Please try your question again in a moment.";
        
        } catch (\Exception $e) {
            Log::error('Exception while calling Gemini API', ['message' => $e->getMessage()]);
            return "Sorry, a system error occurred. Please try again later.";
        }
    }
}