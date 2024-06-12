@extends('layouts.app')

@section('title', 'Post: Edit')

@section('content')
    <h2 class="fw-bold mb-4">Edit Post</h2>

    <form enctype="multipart/form-data" action="{{ route('updatePost', ['postId' => $post->id]) }}" method="POST"
        class="vstack gap-3">
        @csrf
        @method('PATCH')
        <input class="m-0 fw-bold form-control fs-1" placeholder="Insert Title" name="title" value="{{ $post->title }}"
            required />

        <select class="form-select" aria-label="Default select example" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($category->category === $post->category->category) selected @endif>
                    {{ $category->category }}</option>
            @endforeach
        </select>

        <div class="form-control">
            <div>
                <img src="/storage/{{ $post->cover_img }}" id="output" class="border rounded my-2"
                    style="aspect-ratio: 16/9; width: 100%; object-fit: cover" />
            </div>
            <input type="file" accept="image/*" id="inputCover" class="d-none" name="cover_img"
                onchange="loadFile(event)" />
            <label for="inputCover" class="btn btn-secondary my-2">
                Choose a Post Cover
            </label>
        </div>

        <div class="grow-wrap">
            <textarea id="text" class="form-control" placeholder="Insert your content" name="content"
                oninput="this.parentNode.dataset.replicatedValue = this.value" required>{{ $post->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-send"></i>
            Save edit
        </button>
    </form>

    <script>
        let text = document.getElementById('text')
        text.style.height = text.scrollHeight + "px"

        var loadFile = function(event) {
            var output = document.getElementById("output");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src); // free memory
            };
        };
    </script>
@endsection
