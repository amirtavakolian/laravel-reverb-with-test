@extends('layout.master')

@section('panel')
    <h2>Comment Details</h2>
    <div class="mb-3">
        <strong>Body:</strong> {{ $comment->body }}
    </div>
    <div class="mb-3">
        <strong>Post ID:</strong> {{ $comment->post_id }}
    </div>
    <a href="{{ route('comment.index') }}" class="btn btn-secondary">Back to List</a>
@endsection 