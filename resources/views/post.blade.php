@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="d-flex gap-2">
        @can('post.edit', $post, $user)
            <a href="{{ route('postEditPage', ['postId' => $post->id]) }}" class="btn btn-outline-brand">Edit Post</a>
        @endcan
        @can('post.delete', $post, $user)
            <form action="{{ route('deletePost', ['postId' => $post->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-brand"
                    onclick="return confirm('Are you sure you want to delete this post?')">Delete
                    Post</button>
            </form>
        @endcan
    </div>

    <h1 class="m-0 fw-bold text-brand">{{ $post->title }}</h1>
    <h4 class="text-secondary">{{ $post->category->category }}</h4>
    <div class="my-4 py-3 d-flex border-top border-bottom">
        <div data-bs-toggle="dropdown">
            <img class="rounded-circle object-fit-cover" src="/storage/{{ $post->user->profile_img }}"
                style="width: 40px; height: 40px; outline: 1px solid gray" />
        </div>
        <div class="ms-3">
            <p class="m-0">{{ $post->user->username }}</p>
            <p class="m-0 text-secondary">{{ $post->created_at->format('M d, Y') }}</p>
        </div>
    </div>

    <div>
        <img src="/storage/{{ $post->cover_img }}" alt=""
            style="aspect-ratio: 16/9; width: 100%; object-fit: cover" />
    </div>

    <div class="mt-3">
        {{ $post->content }}
    </div>
@endsection
