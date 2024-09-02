<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GptService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY'); // Make sure to set this in your .env file
    }


    public function processDocument($filePath, $prompt)
    {
        // Initialize an empty string to hold the file content
        $fileContent = '';

        // Open the file for reading
        $handle = fopen(storage_path('app/public/' . $filePath), 'rb');
        if ($handle) {
            // Read the file line-by-line
            while (($line = fgets($handle)) !== false) {
                $fileContent .= $line;
            }
            // Close the file handle
            fclose($handle);
        } else {
            // Handle the error if the file cannot be opened
            return 'Error opening the file.';
        }

        // Ensure document content is UTF-8 encoded
        $fileContent = mb_convert_encoding($fileContent, 'UTF-8', 'UTF-8');

        // Ensure prompt is UTF-8 encoded
        $prompt = mb_convert_encoding($prompt, 'UTF-8', 'UTF-8');

        // Call the OpenAI API using a newer model like gpt-3.5-turbo
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a document summarization assistant.'],
                    ['role' => 'user', 'content' => $prompt . "\n\n" . $fileContent],
                ],
                'max_tokens' => 250, // Adjust as needed
                'temperature' => 0.7,
                'top_p' => 1,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
            ]);

            // Handle the response
            if ($response->successful()) {
                return $response->json('choices.0.message.content');
            } else {
                return 'Error processing document: ' . $response->json('error.message');
            }
        } catch (\Exception $e) {
            return 'Exception: ' . $e->getMessage();
        }
    }



}
