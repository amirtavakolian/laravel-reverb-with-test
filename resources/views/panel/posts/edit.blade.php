@extends('layout.master')

@section('panel')
    <h2>Edit Post</h2>
    <form action="{{ route('post-update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-2">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-2">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $post->description) }}</textarea>
            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-2">
            <label>Current Image:</label>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" width="80">
            @else
                <span>No image</span>
            @endif
        </div>
        <div class="form-group mb-2">
            <label>New Image (if you want to change):</label>
            <input type="file" name="image" class="form-control">
            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-2">
            <label>Tags</label>
            <div>
                @foreach($tags as $tag)
                    <label class="me-2">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'checked' : '' }}> {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            @error('tags')<span class="text-danger">{{ $message }}</span>@enderror
            @error('tags.*')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('post-index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection 