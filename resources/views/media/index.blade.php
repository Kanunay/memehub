@extends('layouts.app')
@extends('layouts.nav-bar')
@section('content')
    <div class="container">
        <h2>Uploaded Media</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('media.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="picture">Picture</option>
                    <option value="video">Video</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- Add the hidden input for user_id -->
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <div class="row mt-4">
            @foreach ($media as $item)
                <div class="col-md-4 mb-4">
                    <!-- Display the media item (image or video) -->
                    @if ($item->type === 'picture')
                        <img src="{{ asset('uploads/' . $item->filename) }}" alt="{{ $item->title }}" class="img-fluid">
                    @else
                        <video width="100%" controls>
                            <source src="{{ asset('uploads/' . $item->filename) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                        
                    <!-- Display the media title -->
                    <h5 class="mt-2">{{ $item->title }}</h5>
                        
                    {{-- Description --}}
                    <h5 class="mt-2">{{ $item->description }}</h5>
                    <!-- Buttons for Edit and Delete -->
                    <div class="d-flex">
                        <!-- Edit button -->
                        <a href="{{ route('media.edit', $item) }}" class="btn btn-primary me-2">Edit</a>
                        
                        <!-- Delete button -->
                        <form action="{{ route('media.destroy', $item) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
@endsection
