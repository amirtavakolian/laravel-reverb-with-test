@extends('layout.master')

@section('style')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        th, td {
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        th {
            background-color: #e9ecef;
        }

        .btn-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: background-color 0.2s ease;
            margin-bottom: 1%;
        }

        .btn-link:hover {
            background-color: #0b5ed7;
        }

        .btn-blue {
            background-color: #0d6efd;
            color: #ffffff;
        }

        .btn-red {
            background-color: #d80a0a;
            color: #ffffff;
        }

        .btn-green {
            background-color: #23a400;
            color: #ffffff;
        }

    </style>
@endsection

@section('panel')
    <a href="#" class="btn-link btn-green">Create</a>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @forelse ($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->name }}</td>
                <td>
                    <a href="#" class="btn-link btn-blue">Edit</a>
                    <a href="#" class="btn-link btn-red">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No tags found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
