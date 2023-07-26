@extends('layouts.app')
@extends('layouts.nav-bar')
@section('content')
<div class="container">
    <h1>Edit Media</h1>
    <form action="{{ route('media.update', $media->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $media->title }}">
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="picture" {{ $media->type === 'picture' ? 'selected' : '' }}>Picture</option>
                <option value="video" {{ $media->type === 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">File</label>
            <input type="file" name="file" id="file" class="form-control">
            <small class="form-text text-muted">Upload a new file if you want to change the existing one.</small>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ $media->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

