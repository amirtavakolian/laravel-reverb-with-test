<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('panel.comments.index', compact('comments'));
    }

    public function create()
    {
        return view('panel.comments.create');
    }

    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        Comment::create($data);
        return redirect()->route('comment.index')->with('success', 'Comment created successfully');
    }

    public function show(Comment $comment)
    {
        return view('panel.comments.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        return view('panel.comments.edit', compact('comment'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $data = $request->validated();
        $comment->update($data);
        return redirect()->route('comment.index')->with('success', 'Comment updated successfully');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comment.index')->with('success', 'Comment removed successfully');
    }
}
