@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-12">
            <h5>Upload Document for Processing</h5>
        </div>
    </div>

    <!-- Display success or error messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to upload document -->
    <form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="docName">Document Name</label>
                    <input type="text" name="docName" id="docName" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="filename">Upload Document</label>
                    <input type="file" name="filename" id="filename" class="form-control" accept=".pdf,.doc,.docx,.txt" required>
                </div>

                    <div id="preview"></div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="gpt_prompt">Enter GPT Prompt</label>
                    <textarea name="gpt_prompt" id="gpt_prompt" class="form-control" rows="10" required></textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit for Processing</button>
    </form>
</div>
<script>
    document.getElementById('filename').onchange = function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            var preview = document.getElementById('preview');
            preview.innerHTML = '<iframe src="' + e.target.result + '" width="100%" height="500px"></iframe>';
        };
        reader.readAsDataURL(file);
    };
</script>
@endsection
