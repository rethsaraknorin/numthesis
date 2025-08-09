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
            'get_location' => [
                'kh' => 'សាកលវិទ្យាល័យជាតិគ្រប់គ្រង (NUM) មានទីតាំងនៅផ្លូវ Christopher Howes (៩៦) សង្កាត់វត្តភ្នំ ខណ្ឌដូនពេញ រាជធានីភ្នំពេញ។',
                'en' => 'The National University of Management (NUM) is located at Christopher Howes Street (96), Sangkat Wat Phnom, Khan Daun Penh, Phnom Penh.'
            ],
            'get_rector' => [
                'kh' => 'សាកលវិទ្យាធិការបច្ចុប្បន្នគឺ បណ្ឌិត ហោ ប៉េង។',
                'en' => 'The current Rector is Dr. HOR Peng.'
            ],
            'get_dean_it' => [
                'kh' => 'ព្រឹទ្ធបុរសនៃមហាវិទ្យាល័យបច្ចេកវិទ្យាព័ត៌មាន (FIT) គឺ សាស្ត្រាចារ្យបណ្ឌិត ឆាយ ផាង។',
                'en' => 'The Dean of the Faculty of Information Technology (FIT) is Professor Dr. Chhay Phang.'
            ],
            // --- ADDED NEW INTENT FOR HEAD OF DEPARTMENT ---
            'get_head_of_it_department' => [
                'kh' => 'ប្រធានដេប៉ាតឺម៉ង់នៃមហាវិទ្យាល័យបច្ចេកវិទ្យាព័ត៌មានគឺ សាស្ត្រាចារ្យរងបណ្ឌិត ឈុន រ៉ាឌី។',
                'en' => 'The Head of the Department of the Faculty of Information Technology is Associate Professor Dr. Chhun Rady.'
            ],
            'get_shift_info' => [
                'kh' => 'មាន ៣ វេនសម្រាប់ជ្រើសរើស៖ ពេលព្រឹក ពេលរសៀល និងពេលយប់។',
                'en' => 'There are 3 shifts for students to choose from: Morning, Afternoon, and Night.'
            ],
            'get_shift_change_policy' => [
                'kh' => 'អាចដូរវេនការសិក្សាបានក្រោយពេលចេញលទ្ធផល និងមុនពេលចូលរៀនចាប់ផ្ដើមឆមាសថ្មី អំឡុងពេលនិងអាចបង់លុយមុន ហើយដាក់ពាក្យដូរវេន បាន។',
                'en' => 'You can change your study shift after the results are out and before the new semester begins. During that time, you can pay first and then apply to change shifts.'
            ],
            'get_document_confirmation' => [
                'kh' => 'ការបញ្ជាក់ការសិក្សា បញ្ជាក់ពិន្ទុ បញ្ជាក់លិខិតផ្សេងៗបាន នៅការិយាល័យសិក្សា នៅអគា E ជាន់ផ្ទាល់ដី។ រយៈពេលទទួលបានឯកសារ ១អាទិត្យ អាចមកយកបាន លើកលែងថ្ងៃសៅរិ៍ អាទិត្យ។',
                'en' => 'For study confirmations, score confirmations, or other letters, you can go to the Academic Affairs Office on the ground floor of Building E. It takes one week to receive the documents, and they can be picked up on any day except Saturday and Sunday.'
            ],
            'get_faculty_establishment_date' => [
                'kh' => 'មហាវិទ្យាល័យបច្ចេកវិទ្យាព័ត៌មាន (FIT) ត្រូវបានបង្កើតឡើងក្នុងឆ្នាំ២០០៩។',
                'en' => 'The Faculty of Information Technology (FIT) was established in 2009.'
            ],
            'get_program_overview' => [
                'kh' => "CS (Computer Science): ផ្តោតសំខាន់លើការសរសេរកម្មវិធី ក្បួនដោះស្រាយ និងទ្រឹស្តីកុំព្យូទ័រ។\nIT (Information Technology): ផ្តោតលើការអនុវត្តបច្ចេកវិទ្យាក្នុងការដោះស្រាយបញ្ហានៅក្នុងស្ថាប័ន។\nBIT (Business Information Technology): ជាការរួមបញ្ចូលគ្នារវាង IT និងអាជីវកម្ម ដោយផ្តោតលើការប្រើប្រាស់បច្ចេកវិទ្យាដើម្បីដោះស្រាយបញ្ហាអាជីវកម្ម។\nRobotic: រចនា បង្កើត និងសរសេរកម្មវិធីប្រព័ន្ធឆ្លាតវៃ និងស្វ័យប្រវត្តិកម្ម។",
                'en' => "CS (Computer Science): Focuses on programming, algorithms, and computational theory.\nIT (Information Technology): Focuses on applying computer technology to solve problems in organizations.\nBIT (Business Information Technology): A combination of IT and business, preparing students to apply IT in the business world.\nRobotic: Design, build, and program intelligent and automated systems."
            ],
            'get_it_requirements' => [
                'kh' => 'សម្រាប់ការសិក្សាផ្នែក IT អ្នកត្រូវមានចំណេះដឹងភាសាអង់គ្លេស និងគណិតវិទ្យាកម្រិតមធ្យម ហើយសម្រាប់អ្នកដែលទទួលបានសញ្ញាបត្រនិទ្ទេស A-D ក៏អាចសិក្សាជំនាញនេះបានដែរ។',
                'en' => 'For IT, you need to know English and intermediate math, and for those who receive A-D certificates, you can learn IT.'
            ]
        ];
        return $answers[$intent][$language] ?? null;
    }

    /**
     * This function uses the AI to classify the user's intent.
     */
    private function classifyUserIntent(string $userText): string
    {
        $intents = [
            'get_location', 'get_rector', 'get_dean_it', 'get_head_of_it_department', 'get_shift_info', 'get_shift_change_policy',
            'get_document_confirmation', 'get_faculty_establishment_date', 'get_program_overview',
            'get_program_comparison',
            'get_it_requirements',
            'ask_about_program', 'general_conversation'
        ];
        
        $prompt = "Based on the user's question, classify it into ONE of the following categories: " . implode(', ', $intents) . ". Respond with ONLY the category name.\n\n";
        $prompt .= "Hints:\n";
        // --- IMPROVED HINTS FOR CLARITY ---
        $prompt .= "- If they ask about the Rector (សាកលវិទ្យាធិការ), the head of the whole university, use 'get_rector'.\n";
        $prompt .= "- If they ask about the Dean (ព្រឹទ្ធបុរស), the head of the IT Faculty, 'អ្នកគ្រប់គ្រងមហាវិទ្យាល័យ IT', or 'manager of the IT faculty', use 'get_dean_it'.\n";
        $prompt .= "- If they ask about the Head of the IT Department (ប្រធានដេប៉ាតឺម៉ង់), use 'get_head_of_it_department'.\n";
        $prompt .= "- If they ask when the faculty was created or established, use 'get_faculty_establishment_date'.\n";
        $prompt .= "- If they ask what IT, CS, or BIT are about in general, use 'get_program_overview'.\n";
        $prompt .= "- If they ask for the difference or comparison between any two programs (e.g., 'compare CS and IT', 'IT vs BIT'), use 'get_program_comparison'.\n";
        $prompt .= "- If they ask about what is needed or required to learn/study IT, use 'get_it_requirements'.\n";
        $prompt .= "- If they ask about a single specific program's details (like price or curriculum), use 'ask_about_program'.\n\n";
        $prompt .= "User Question: \"{$userText}\"";

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

        $isListAllQuery = preg_match('/how many program(s)?|what program(s)?|list (of )?program(s)?|all program(s)?|what are they|what they are|ជំនាញអ្វីខ្លះ|មានជំនាញអ្វីខ្លះ|ជំនាញអីខ្លះ|ជំនាញអី|ជំនាញអី្វ/i', $userText);
        if ($isListAllQuery) {
            return $this->handleListAllPrograms($language);
        }

        $intent = $this->classifyUserIntent($userText);

        if ($intent === 'get_program_comparison') {
            return $this->handleProgramComparison($userText, $language);
        }

        $predefinedAnswer = $this->getPredefinedAnswer($intent, $language);
        if ($predefinedAnswer !== null) {
            return $predefinedAnswer;
        }

        $contextResult = $this->gatherContext($userText);
        if ($contextResult['type'] === 'direct') {
            return $contextResult['content'];
        }

        $context = $contextResult['content'];
        $contextFound = !empty(trim($context));

        $prompt = "You are NUM-Bot, a helpful AI assistant for NUM's IT Faculty.\n";
        
        if ($language === 'kh') {
            $prompt .= "You MUST respond using ONLY the Khmer alphabet (អក្សរខ្មែរ).\n\n";
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
    
    private function handleListAllPrograms(string $language): string
    {
        $allPrograms = Program::all();
        if ($allPrograms->isEmpty()) {
            return $language === 'kh' ? 'មិនមានកម្មវិធីសិក្សាទេ' : 'There are no programs available.';
        }

        $programCount = $allPrograms->count();
        
        if ($language === 'kh') {
            $content = "មានកម្មវិធីសិក្សាសរុបចំនួន {$programCount} នៅមហាវិទ្យាល័យព័ត៌មានវិទ្យា។ កម្មវិធីទាំងនោះរួមមានតម្លៃសិក្សាដូចខាងក្រោម៖\n\n";
            foreach ($allPrograms as $program) {
                $programName = $program->name;
                $price = $program->price_per_year ?? 'N/A';
                $content .= "- {$programName} ({$program->code}): \${$price} ក្នុងមួយឆ្នាំ\n";
            }
        } else {
            $content = "There are a total of {$programCount} programs in the IT Faculty. Here is the full list with prices per year:\n\n";
            foreach ($allPrograms as $program) {
                $price = $program->price_per_year ?? 'N/A';
                $content .= "- {$program->name} ({$program->code}): \${$price}\n";
            }
        }
        return $content;
    }
    
    private function handleProgramComparison(string $userText, string $language): string
    {
        $allPrograms = Program::all();
        $programList = $allPrograms->map(fn($p) => "{$p->name} ({$p->code})")->implode(', ');

        $extractionPrompt = "From the user's question, identify the program codes or names being compared. The available programs are: {$programList}. Respond with a comma-separated list of the program codes (e.g., CS,IT). If you cannot confidently identify at least two distinct programs from the list, respond with 'NONE'.\n\nUser Question: \"{$userText}\"";
        
        $identifiedCodesText = $this->callGeminiApi($extractionPrompt, 'gemini-1.5-flash');
        $identifiedCodes = array_filter(array_map('trim', explode(',', $identifiedCodesText)));

        if (count($identifiedCodes) < 2) {
            if (stripos($userText, 'robotic') !== false) {
                return $language === 'kh' 
                    ? 'មហាវិទ្យាល័យពត៌មានវិទ្យាបច្ចុប្បន្នមិនមានជំនាញមនុស្សយន្ត (Robotics) ដាច់ដោយឡែកនោះទេ។ ទោះយ៉ាងណា គោលគំនិតពាក់ព័ន្ធមួយចំនួនអាចត្រូវបានរៀននៅក្នុងកម្មវិធីសិក្សា Computer Science (CS)។' 
                    : "The Faculty of IT does not currently offer a dedicated program in Robotics. However, some related concepts may be covered within the Computer Science (CS) program.";
            }
            return $this->handleQuery($userText, new TelegramUser(['language_preference' => $language]));
        }

        $comparisonContext = "";
        $programNames = [];
        foreach ($identifiedCodes as $code) {
            $program = $allPrograms->first(fn($p) => strcasecmp($p->code, $code) === 0);
            if ($program) {
                $comparisonContext .= $this->buildContextForProgram($program) . "\n";
                $programNames[] = $program->name;
            }
        }

        if (empty($comparisonContext)) {
             return $this->handleQuery($userText, new TelegramUser(['language_preference' => $language]));
        }

        $comparisonPrompt = "You are NUM-Bot, a helpful AI assistant for NUM's IT Faculty.\n";
        if ($language === 'kh') {
            $comparisonPrompt .= "អ្នកត្រូវតែឆ្លើយជាអក្សរខ្មែរតែប៉ុណ្ណោះ។ ដោយផ្អែកលើតែข้อมูลด้านล่างนี้ សូមពន្យល់ពីความแตกต่างที่สำคัญរវាងកម្មវិធីសិក្សា " . implode(' និង ', $programNames) . "។\n\n";
        } else {
            $comparisonPrompt .= "You must respond ONLY in English. Based ONLY on the context below, explain the key differences between the " . implode(' and ', $programNames) . " programs.\n\n";
        }

        $comparisonPrompt .= "--- DATABASE CONTEXT ---\n{$comparisonContext}\n------------------------\n\n";
        $comparisonPrompt .= "Answer concisely and clearly.";

        return $this->callGeminiApi($comparisonPrompt);
    }

    private function gatherContext(string $userText): array
    {
        $allPrograms = Program::all();

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