@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content">{{ old('content', $post->content) }}</textarea>
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <select multiple class="form-control" id="tags" name="tags[]">
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        <input type="text" id="new-tag" class="form-control mt-2" placeholder="Add new tag">
    
        <button type="button" id="add-tag" class="btn btn-primary mt-2">Add Tag</button>
        
    </div>
    <div class="form-group">
            <label for="file">Upload Photo/Video</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection