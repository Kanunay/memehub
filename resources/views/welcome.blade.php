@extends('layouts.app')
@extends('layouts.nav-bar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md m-0 p-0">
            <div class="container bg-white border rounded m-0 p-0">
                <!-- Rest of the content here -->
                <h1 class="mt-1 p-3 ">Media Gallery</h1>
                <div class=" justify-content-center  ">
                    @foreach ($media as $item)
                        <div width="" height="10vh" class="container text-center bg-light border-dark m-0 p-0 "> <!-- Added 'text-center' class here -->
                            <!-- Display the media title -->
                            <h1 class="mt-2 bg-white border-dark">{{ $item->title }}</h1>
                            <!-- Display the media item (image or video) -->
                            @if ($item->type === 'picture')
                                <img  src="{{ asset('uploads/' . $item->filename) }}" alt="{{ $item->title }}" class="img-fluid">
                            @else
                                <video  controls>
                                    <source src="{{ asset('uploads/' . $item->filename) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif

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
                                    <button type="submit" class="btn btn-danger ">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
