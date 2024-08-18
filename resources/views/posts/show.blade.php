@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>

<h3>Comments</h3>
<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <textarea class="form-control" name="content" placeholder="Add a comment">{{ old('content') }}</textarea>
    </div>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <button type="submit" class="btn btn-primary">Comment</button>
</form>
<ul class="list-group mt-3">
    @foreach ($post->comments as $comment)
        <li class="list-group-item">
            {{ $comment->content }}

            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="float-right">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>

        </li>
    @endforeach
</ul>

<h3>Media</h3>
    @foreach ($post->medias as $media)
        @if (Str::startsWith($media->file_type, 'image/'))
            <img src="{{ Storage::url($media->file_path) }}" alt="Image" width="100">
        @elseif (Str::startsWith($media->file_type, 'video/'))
            <video src="{{ Storage::url($media->file_path) }}" controls width="100"></video>
        @endif
    @endforeach
@endsection