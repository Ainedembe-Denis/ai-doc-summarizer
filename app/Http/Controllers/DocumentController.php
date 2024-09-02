<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Services\GptService;

class DocumentController extends Controller
{
    protected $gptService;

    public function __construct(GptService $gptService)
    {
        $this->gptService = $gptService;
    }


    public function index()
    {
        $documents = Document::where('created_by', auth()->id())->get();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        // Return the view for document upload
        return view('documents.document_upload');
    }

    public function show($id)
    {
        // Retrieve the document by its ID
        $document = Document::findOrFail($id);

        // Return the view with the document data
        return view('documents.show', compact('document'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'docName' => 'required|string|max:255',
            'filename' => 'required|file|mimes:pdf,txt',
            'gpt_prompt' => 'required|string',
        ]);

        $path = $request->file('filename')->store('documents');

        $document = Document::create([
            'docName' => $request->docName,
            'filename' => $path,
            'gpt_prompt' => $request->gpt_prompt,
            'created_by' => auth()->id(),
        ]);

        // Call ChatGPT API here and save the response
        $response = $this->callGPTAPI($request->gpt_prompt);
        $document->gpt_processed_data = $response;
        $document->save();

        return redirect()->route('documents.show', $document->id);
    }

    private function callGPTAPI($prompt)
    {
        // Implement the logic to call ChatGPT API
        return 'Mocked GPT response for: ' . $prompt;
    }

    public function listProcessedDocuments()
    {
        // Retrieve all documents where gpt_processed_data is not null
        $documents = Document::whereNotNull('gpt_processed_data')->get();

        return view('documents.list', compact('documents'));
    }


    public function uploadDocument(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'docName' => 'required|string|max:255',
            'filename' => 'required|file|mimes:pdf,doc,docx,txt',
            'gpt_prompt' => 'required|string|max:5000',
        ]);

        // Handle file upload
        if ($request->hasFile('filename')) {
            // Store the file in the 'documents' directory
            $filePath = $request->file('filename')->store('documents', 'public');

            // Create a new Document record
            $document = Document::create([
                'docName' => $request->docName,
                'filename' => $filePath,
                'gpt_prompt' => $request->gpt_prompt,
                'created_by' => auth()->user()->id,
            ]);

            // Here, you would typically send the document content and prompt to the GPT API
            // Assuming you have a service to handle the GPT API call, you could do something like:
            $processedData = $this->gptService->processDocument($filePath, $request->gpt_prompt);
            $document->gpt_processed_data = $processedData;
            $document->save();

            //return redirect()->route('documents.processed')->with('success', 'Document uploaded and processed successfully!');

            return redirect()->route('documents.processed');
        }

        return back()->withErrors('File upload failed.');
    }

}
