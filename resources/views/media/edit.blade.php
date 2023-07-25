@extends('layouts.app')
@extends('layouts.nav-bar')
@section('content')
    <div class="container">
        <h1>Edit Media</h1>
        <form action="{{ route('media.update', $media->id) }}" method="post">
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

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

