@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Create Post</h2>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select multiple class="form-control" id="tags" name="tags[]">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" id="new-tag" class="form-control mt-2" placeholder="Add new tag">
                    <button type="button" id="add-tag" class="btn btn-primary mt-2">Add Tag</button>
                </div>
                <div class="form-group">
                    <label for="file">Upload Photo/Video</label>
                    <input type="file" class="form-control" id="file" name="file">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#add-tag').on('click', function () {
                let newTag = $('#new-tag').val();
                if (newTag) {
                    $.ajax({
                        url: "{{ route('tags.store') }}",
                        method: 'POST',
                        data: {
                            name: newTag,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (tag) {
                            $('#tags').append(`<option value="${tag.id}" selected>${tag.name}</option>`);
                            $('#new-tag').val('');
                        }
                    });
                }
            });
        });
    </script>
@endpush