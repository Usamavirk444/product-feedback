@extends('dashboard')

@section('body')
    <div class="container p-5">
        <h1>Submit Feedback</h1>
        @include('alerts')
        <form method="POST" action="{{ route('feedback.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group p-2">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group p-2">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group p-2">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="bug">Bug Report</option>
                    <option value="feature">Feature Request</option>
                    <option value="improvement">Improvement</option>
                </select>
                @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group p-2">
                <label for="attachments">Attachments</label>
                <input type="file" name="attachments[]" id="attachments" accept="image/png, image/gif, image/jpeg" class="form-control-file" multiple>
                @error('attachments')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-outline-primary float-end m-4">Submit</button>

        </form>
    </div>
@endsection
