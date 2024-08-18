@extends('layouts.app')

@section('content')
<h1>Posts</h1>
<a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create Post</a>
<div class="list-group">
    @foreach ($posts as $post)
        <div class="list-group-item">
            <h5>{{ $post->title }}</h5>
            <p>{{ $post->content }}</p>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    @endforeach
</div>
@endsection