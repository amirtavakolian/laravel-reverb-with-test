<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('panel.posts.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('panel.posts.create', compact('tags'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $data['user_id'] = auth()->user()->id;

        $post = Post::create($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.index')->with('success', 'post created successfully');

    }

    public function show(Post $post)
    {
        return view('panel.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('panel.posts.edit', compact('post', 'tags'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }
        $tags = $data['tags'] ?? [];
        unset($data['tags']);
        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post-index')->with('success', 'post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post-index')->with('success', 'post removed successfully');
    }
}
