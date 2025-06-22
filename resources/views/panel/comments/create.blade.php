@extends('layout.master')

@section('panel')
    <h2>Create New Comment</h2>
    <form action="{{ route('comment.store') }}" method="POST">
        @csrf
        <div class="form-group mb-2">
            <label>Body</label>
            <textarea name="body" class="form-control">{{ old('body') }}</textarea>
            @error('body')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group mb-2">
            <label>Post ID</label>
            <input type="number" name="post_id" class="form-control" value="{{ old('post_id') }}">
            @error('post_id')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('comment.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection 