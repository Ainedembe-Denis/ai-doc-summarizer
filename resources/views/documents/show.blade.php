@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $document->docName }}</h1>

    <div class="card">
      <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <p><strong>Filename:</strong> {{ $document->filename }}</p>
                    <p><strong>GPT Prompt:</strong> {{ $document->gpt_prompt }}</p>
                    <p><strong>Processed Data:</strong></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    {{ $document->gpt_processed_data }}
                </div>
            </div>

      </div>
    </div>

    <a href="{{ route('documents.processed') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
