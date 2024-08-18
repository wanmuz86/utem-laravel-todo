<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Media;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'tags' => 'array'
        ]);

        $post = Post::create($request->only('title', 'content'));
       
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

       
        if ($request->file('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            Media::create([
                'file_path' => $path,
                'file_type' => $request->file('file')->getClientMimeType(),
                'post_id' => $post->id,
            ]);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        return view('posts.edit', compact('post','tags'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->only('title', 'content'));
        $post->tags()->sync($request->tags);
        
        if ($request->file('file')) {
            $path = $request->file('file')->store('uploads', 'public');
            Media::create([
                'file_path' => $path,
                'file_type' => $request->file('file')->getClientMimeType(),
                'post_id' => $post->id,
            ]);
        }


        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
