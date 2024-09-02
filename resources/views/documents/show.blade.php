@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $document->docName }}</h1>

    <p><strong>Filename:</strong> {{ $document->filename }}</p>
    <p><strong>GPT Prompt:</strong> {{ $document->gpt_prompt }}</p>
    <p><strong>Processed Data:</strong></p>
    <pre>{{ $document->gpt_processed_data }}</pre>

    <a href="{{ route('documents.processed') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
