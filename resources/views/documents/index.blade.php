<h1>Your Documents</h1>
<ul>
    @foreach ($documents as $document)
        <li><a href="{{ route('documents.show', $document->id) }}">{{ $document->docName }}</a></li>
    @endforeach
</ul>
