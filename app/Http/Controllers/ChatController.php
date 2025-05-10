<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Throwable;

class ChatController extends Controller
{
    /**
     * Handle the incoming request and format the response in a structured way.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function __invoke(Request $request): string
    {
        // Validate incoming request
        $request->validate([
            'content' => 'required|string|max:2000',
            'model' => 'sometimes|string',
        ]);

        // Set default model if not provided
        $model = $request->post('model', 'jamba-large-1.6');
        
        // Get user query
        $userQuery = $request->post('content');
        
        // Record user query in search statistics
        $this->recordSearchQuery($userQuery);
        
        // Set API parameters
        $maxRetries = 3;
        $delayBetweenRetries = 5;
        $defaultResponse = "I apologize, but I'm unable to process your request at the moment. Please try again later.";

        // Check if API key is set
        if (empty(env('AI21_API_KEY'))) {
            Log::error("AI21 API key is missing");
            return "Configuration error: API key is missing. Please contact the administrator.";
        }

        // Try to get response from AI21 API
        for ($attempt = 0; $attempt < $maxRetries; $attempt++) {
            try {
                // Log attempt information
                if ($attempt > 0) {
                    Log::info("AI21 API Retry #{$attempt}");
                }

                // Create system message for structured formatting
                $systemMessage = "You are an educational assistant for the Schools Division Office (SDO) of San Carlos City, Pangasinan, Region I. 
                Format your responses in a well-structured way similar to ChatGPT with:
                1. Clear headings using bold text (**Heading**)
                2. Well-organized bullet points where appropriate
                3. Short, concise paragraphs
                4. Numbered lists for sequential information
                5. Occasional emphasis on important points using bold or italics
                Be informative but concise, and organize information in a hierarchical, easy-to-scan structure.";

                // Log the request we're about to make (for debugging)
                Log::debug("AI21 API Request: Model={$model}, Query Length=" . strlen($userQuery));
                
                // Make API request
                $response = Http::timeout(30)
                    ->withHeaders([
                        "Authorization" => "Bearer " . env('AI21_API_KEY'),
                        "Content-Type" => "application/json",
                    ])
                    ->post('https://api.ai21.com/studio/v1/chat/completions', [
                        "model" => $model,
                        "messages" => [
                            ["role" => "system", "content" => $systemMessage],
                            ["role" => "user", "content" => $userQuery]
                        ],
                        "documents" => [],
                        "tools" => [],
                        "n" => 1,
                        "max_tokens" => 2048,
                        "temperature" => 0.4,
                        "top_p" => 1,
                        "stop" => [],
                        "response_format" => ["type" => "text"],
                    ]);

                // Process successful response
                if ($response->successful()) {
                    $responseData = $response->json();
                    
                    Log::debug("AI21 API Response: " . json_encode($response->json()));
                    
                    if (isset($responseData['choices'][0]['message']['content'])) {
                        $content = $responseData['choices'][0]['message']['content'];
                        
                        // Process the content to ensure proper HTML rendering in the chat
                        $content = $this->formatResponse($content);
                        
                        return $content;
                    } else {
                        Log::error("AI21 API Response missing expected content structure: " . json_encode($responseData));
                    }
                    
                    // Handle API error response
                    if (isset($responseData['error'])) {
                        Log::error("AI21 API Error: " . $responseData['error']['message']);
                        return "I encountered an error: " . $responseData['error']['message'];
                    }
                } else {
                    // Log failed response status and body for debugging
                    Log::warning("AI21 API response status: " . $response->status());
                    Log::warning("AI21 API response body: " . $response->body());
                }
                
            } catch (Throwable $e) {
                // Log exception with more details
                Log::error("AI21 API Exception: " . $e->getMessage());
                Log::error("Exception trace: " . $e->getTraceAsString());
                
                // Wait before retrying
                if ($attempt < $maxRetries - 1) {
                    sleep($delayBetweenRetries);
                }
            }
        }

        // Return default response if all attempts fail
        Log::error("AI21 API: All retry attempts failed");
        return $defaultResponse;
    }

    /**
     * Record user search query for analytics
     *
     * @param string $query
     * @return void
     */
    private function recordSearchQuery(string $query): void
    {
        try {
            // Normalize the query (lowercase, trim, etc.)
            $normalizedQuery = strtolower(trim($query));
            
            // Only record significant queries (more than 3 characters)
            if (strlen($normalizedQuery) <= 3) {
                return;
            }
            
            // Insert or update query count in the database
            DB::table('search_statistics')
                ->updateOrInsert(
                    ['query' => $normalizedQuery],
                    [
                        'count' => DB::raw('count + 1'),
                        'last_searched_at' => now()
                    ]
                );
                
            // Clear the FAQs cache to update with new data
            Cache::forget('frequent_searches');
            
        } catch (Throwable $e) {
            // Log but don't stop execution for statistics errors
            Log::error("Failed to record search statistics: " . $e->getMessage());
        }
    }

    /**
     * Get frequently asked questions for the FAQ section
     * 
     * @param int $limit
     * @return array
     */
    public function getFrequentSearches(int $limit = 10): array
    {
        try {
            // Try to get from cache first
            return Cache::remember('frequent_searches', 3600, function () use ($limit) {
                // Get top queries from the database
                return DB::table('search_statistics')
                    ->orderBy('count', 'desc')
                    ->limit($limit)
                    ->get(['query', 'count', 'last_searched_at'])
                    ->toArray();
            });
        } catch (Throwable $e) {
            Log::error("Failed to get frequent searches: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Format the response content for proper rendering in the chat.
     * Converts markdown to appropriate HTML while preserving structure.
     *
     * @param string $content
     * @return string
     */
    private function formatResponse(string $content): string
    {
        // Replace markdown headings with HTML headings 
        // Convert **bold** to <strong> tags
        $content = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $content);
        
        // Convert *italic* to <em> tags
        $content = preg_replace('/\*(.*?)\*/s', '<em>$1</em>', $content);
        
        // Handle lists better (convert markdown lists to HTML lists)
        // First, identify and process unordered lists
        $content = preg_replace_callback('/(?:^|\n)(\s*[-*]\s+.+)(?:\n\s*[-*]\s+.+)*/', function($matches) {
            $listItems = preg_split('/\n\s*[-*]\s+/', "\n" . $matches[0]);
            array_shift($listItems); // Remove the first empty element
            
            $html = '<ul>';
            foreach ($listItems as $item) {
                $html .= '<li>' . trim($item) . '</li>';
            }
            $html .= '</ul>';
            
            return $html;
        }, $content);
        
        // Then, identify and process ordered lists
        $content = preg_replace_callback('/(?:^|\n)(\s*\d+\.\s+.+)(?:\n\s*\d+\.\s+.+)*/', function($matches) {
            $listItems = preg_split('/\n\s*\d+\.\s+/', "\n" . $matches[0]);
            array_shift($listItems); // Remove the first empty element
            
            $html = '<ol>';
            foreach ($listItems as $item) {
                $html .= '<li>' . trim($item) . '</li>';
            }
            $html .= '</ol>';
            
            return $html;
        }, $content);
        
        // Convert double newlines to paragraph breaks
        $paragraphs = explode("\n\n", $content);
        $formattedParagraphs = array_map(function($paragraph) {
            // Skip wrapping paragraphs that are already HTML (lists, etc.)
            if (preg_match('/^<(ul|ol|h[1-6]|div|p)/', trim($paragraph))) {
                return $paragraph;
            }
            return '<p>' . trim($paragraph) . '</p>';
        }, $paragraphs);
        
        $content = implode("\n", $formattedParagraphs);
        
        // Convert single newlines within paragraphs to <br> tags
        $content = preg_replace_callback('/<p>(.*?)<\/p>/s', function($matches) {
            return '<p>' . str_replace("\n", '<br>', $matches[1]) . '</p>';
        }, $content);
        
        return $content;
    }
    
    /**
     * API endpoint to get frequent searches
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function frequentSearches(Request $request)
    {
        $limit = $request->input('limit', 10);
        $searches = $this->getFrequentSearches($limit);
        
        return response()->json([
            'success' => true,
            'data' => $searches
        ]);
    }

    /**
     * Debug endpoint to test API connectivity
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function testApiConnection()
    {
        try {
            // Create a simple test request
            $response = Http::timeout(10)
                ->withHeaders([
                    "Authorization" => "Bearer " . env('AI21_API_KEY'),
                    "Content-Type" => "application/json",
                ])
                ->post('https://api.ai21.com/studio/v1/chat/completions', [
                    "model" => "jamba-large-1.6",
                    "messages" => [
                        ["role" => "system", "content" => "You are a helpful assistant."],
                        ["role" => "user", "content" => "Say hello"]
                    ],
                    "max_tokens" => 50,
                ]);
            
            return response()->json([
                'status' => $response->successful() ? 'success' : 'error',
                'status_code' => $response->status(),
                'response' => $response->json(),
            ]);
            
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'exception',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], 500);
        }
    }
}