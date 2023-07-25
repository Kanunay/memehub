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
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" class="form-control" required>
                    <option value="picture">Picture</option>
                    <option value="video">Video</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <div class="row mt-4">
            @foreach ($media as $item)
                <div class="col-md-4 mb-4">
                    @if ($item->type === 'picture')
                        <img src="{{ asset('uploads/' . $item->filename) }}" alt="{{ $item->title }}" class="img-fluid">
                    @else
                        <video width="100%" controls>
                            <source src="{{ asset('uploads/' . $item->filename) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                    <h5 class="mt-2">{{ $item->title }}</h5>
                    <form action="{{ route('media.destroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
