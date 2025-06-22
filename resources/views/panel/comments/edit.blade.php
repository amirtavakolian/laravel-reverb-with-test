@extends('layout.master')

@section('panel')
    <h2>Edit Comment</h2>
    <form action="{{ route('comment.update', $comment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-2">
            <label>Body</label>
            <textarea name="body" class="form-control">{{ old('body', $comment->body) }}</textarea>
            @error('body')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-2">
            <label>Post ID</label>
            <input type="number" name="post_id" class="form-control" value="{{ old('post_id', $comment->post_id) }}">
            @error('post_id')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('comment.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection 