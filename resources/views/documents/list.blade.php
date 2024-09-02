@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Processed Documents</h1>
    @if ($documents->isEmpty())
        <p>No processed documents found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Document Name</th>
                    <th>Filename</th>
                    <th>GPT Prompt</th>
                    <th>Processed Data</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>{{ $document->docName }}</td>
                        <td>{{ $document->filename }}</td>
                        <td>{{ $document->gpt_prompt }}</td>
                        <td>{{ $document->gpt_processed_data }}</td>
                        <td>{{ $document->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
