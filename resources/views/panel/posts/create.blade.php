@extends('layout.master')

@section('style')
    <style>
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .form-control, textarea {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        .tag-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        .tag-list label {
            background: #f1f3f4;
            border-radius: 0.375rem;
            padding: 0.25rem 0.75rem;
            cursor: pointer;
            font-size: 0.97rem;
            display: flex;
            align-items: center;
        }
        .tag-list input[type="checkbox"] {
            margin-right: 0.4em;
        }
        .btn-primary {
            background: linear-gradient(90deg, #4f8cff, #2355d8);
            border: none;
            color: #fff;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            font-size: 1.1rem;
            font-weight: 500;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #2355d8, #4f8cff);
        }
        .btn-secondary {
            background: #e9ecef;
            color: #333;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            font-size: 1.1rem;
            margin-left: 0.5rem;
        }
        .text-danger {
            color: #d90429;
            font-size: 0.97rem;
        }
    </style>
@endsection

@section('panel')
    <h2 style="margin-bottom: 1.5rem;">Create New Post</h2>
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 600px; margin: 0 auto;">
        @csrf
        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Tags</label>
            <div class="tag-list">
                @foreach($tags as $tag)
                    <label>
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}> {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            @error('tags')<span class="text-danger">{{ $message }}</span>@enderror
            @error('tags.*')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div style="margin-top: 2rem; text-align: right;">
            <button type="submit" class="btn-primary">Submit</button>
            <a href="{{ route('post.index') }}" class="btn-secondary">Back</a>
        </div>
    </form>
@endsection
