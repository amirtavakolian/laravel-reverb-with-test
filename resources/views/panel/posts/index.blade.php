@extends('layout.master')

@section('style')
    <style>
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .custom-table th, .custom-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid #e9ecef;
            text-align: left;
        }
        .custom-table th {
            background: #f8f9fa;
            font-weight: 600;
        }
        .custom-table tr:last-child td {
            border-bottom: none;
        }
        .post-img-thumb {
            width: 60px;
            height: 40px;
            object-fit: cover;
            border-radius: 0.25rem;
            border: 1px solid #e9ecef;
        }
        .btn-action {
            padding: 0.35rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.97rem;
            margin-right: 0.3rem;
            border: none;
            transition: background 0.2s;
        }
        .btn-info { background: #4f8cff; color: #fff; }
        .btn-info:hover { background: #2355d8; }
        .btn-warning { background: #ffd966; color: #333; }
        .btn-warning:hover { background: #ffb700; }
        .btn-danger { background: #ff6b6b; color: #fff; }
        .btn-danger:hover { background: #d90429; }
        .btn-success { background: #51cf66; color: #fff; border: none; }
        .btn-success:hover { background: #339966; }
        .truncate {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection

@section('panel')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="margin: 0;">Posts List</h2>
        <a href="{{ route('post.create') }}" class="btn-success btn-action">Create New Post</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td class="truncate" title="{{ $post->description }}">{{ Str::limit($post->description, 50) }}</td>
                        <td>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="post-img-thumb">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('post.show', $post) }}" class="btn-info btn-action">Show</a>
                            <a href="{{ route('post.edit', $post) }}" class="btn-warning btn-action">Edit</a>
                            <form action="{{ route('post.destroy', $post) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger btn-action" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top: 1.5rem;">
        {{ $posts->links() }}
    </div>
@endsection
