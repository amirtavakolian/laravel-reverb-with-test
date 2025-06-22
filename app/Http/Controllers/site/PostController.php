<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class PostController extends Controller
{

    public function posts()
    {
        $posts = Post::all();

        return view('site.posts', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('comments');
        return view('site.single', compact('post'));
    }

    public function storeComment(StoreCommentRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['is_approved'] = 0;
        Comment::create($data);
        return redirect()->route('site.post.show', $post)->with('success', 'Comment submitted and awaiting approval.');
    }
}
