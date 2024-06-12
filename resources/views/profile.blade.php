@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="d-flex flex-column align-items-center mb-5">
        <img class="rounded-circle object-fit-cover" src="/storage/{{ $user->profile_img }}"
            style="width: 150px; aspect-ratio: 1; outline: 1px solid gray" />
        <h4 class="mt-3 mb-1">{{ $user->username }}</h4>
        <p class="m-0 text-secondary">{{ $user->email }}</p>
        @if (auth()->user() && auth()->user()->id === $user->id)
            <a href="/profile/{{ $user->id }}/edit" class="btn btn-outline-brand mt-3">Edit profile</a>
        @endif
    </div>

    <h2 class="fw-bold mb-4">Posts</h2>

    <!-- Filter and Search -->
    <div class="d-flex justify-content-between mb-3">
        <!-- Filter button -->
        <div class="d-flex">
            <div class="dropdown">
                <button class="btn btn-outline-secondary rounded-pill text-white" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel"></i>
                    {{ $displayCategory }}
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('profile', array_merge(request()->query(), ['category' => '', 'userId' => $user->id])) }}">All</a>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('profile', array_merge(request()->query(), ['category' => $category->id, 'userId' => $user->id])) }}">{{ $category->category }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Search Bar -->
        <div style="max-width: 300px">
            <form action="{{ route('profile', ['userId' => $user->id]) }}" method="GET" class="input-group">
                <input type="hidden" name="category" value="{{ request()->input('category') }}">
                <input type="text" class="form-control rounded-start-pill" placeholder="Search post" name="search"
                    value="{{ request()->input('search') }}" />
                <button class="btn btn-outline-secondary rounded-end-pill text-white" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
    <!-- End Filter and Search -->

    @include('partials.posts-list', ['posts', $posts])
@endsection
