@extends('layouts.app')

@section('title', 'Post: create')

@section('content')
    <h2 class="fw-bold mb-4">Create Post</h2>

    <form enctype="multipart/form-data" action="/posts" method="POST" class="vstack gap-3">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input class="m-0 fw-bold form-control fs-1" placeholder="Insert Title" name="title" required />

        <select class="form-select" aria-label="Default select example" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category }}</option>
            @endforeach
        </select>

        <div class="form-control">
            <div>
                <img src="/img/post_cover_empty.png" id="output" class="border rounded my-2"
                    style="aspect-ratio: 16/9; width: 100%; object-fit: cover" />
            </div>
            <input type="file" accept="image/*" id="inputCover" class="d-none" name="cover_img"
                onchange="loadFile(event)" required />
            <label for="inputCover" class="btn btn-secondary my-2">
                Choose a Post Cover
            </label>
        </div>

        <div class="grow-wrap">
            <textarea id="text" class="form-control" placeholder="Insert your content" name="content"
                oninput="this.parentNode.dataset.replicatedValue = this.value" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-send"></i>
            Publish
        </button>
    </form>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById("output");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src); // free memory
            };
        };
    </script>
@endsection
