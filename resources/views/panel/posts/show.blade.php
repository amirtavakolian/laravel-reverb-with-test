@extends('layout.master')

@section('panel')
    <h2>Post Details</h2>
    <div class="mb-3">
        <strong>Title:</strong> {{ $post->title }}
    </div>
    <div class="mb-3">
        <strong>Description:</strong> <div>{{ $post->description }}</div>
    </div>
    <div class="mb-3">
        <strong>Image:</strong>
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" width="200">
        @else
            <span>No image</span>
        @endif
    </div>
    <div class="mb-4">
        <strong>Comments:</strong>
        @if($post->comments->count())
            <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                @foreach($post->comments as $comment)
                    <li style="background: #f8f9fa; border-radius: 0.375rem; margin-bottom: 0.75rem; padding: 0.75rem 1rem; border: 1px solid #e9ecef;">
                        <div style="font-size: 1rem; color: #333;">{{ $comment->content }}</div>
                        <div style="font-size: 0.9rem; color: #888; margin-top: 0.25rem;">Comment ID: {{ $comment->id }}</div>
                    </li>
                @endforeach
            </ul>
        @else
            <div style="color: #888; margin-top: 0.5rem;">No comments for this post.</div>
        @endif
    </div>
    <a href="{{ route('post.index') }}" class="btn btn-secondary">Back to List</a>
@endsection
