@extends('layout.master')

@section('panel')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Comments List</h2>
        <a href="{{ route('comment.create') }}" class="btn btn-success">Create New Comment</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Body</th>
                <th>Post ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ Str::limit($comment->body, 50) }}</td>
                    <td>{{ $comment->post_id }}</td>
                    <td>
                        <a href="{{ route('comment.show', $comment) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('comment.edit', $comment) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('comment.destroy', $comment) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $comments->links() }}
@endsection 