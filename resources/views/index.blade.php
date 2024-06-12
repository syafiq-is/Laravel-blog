@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h2 class="fw-bold mb-4">All Posts</h2>

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
                            href="{{ route('posts', array_merge(request()->query(), ['category' => ''])) }}">All</a>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('posts', array_merge(request()->query(), ['category' => $category->id])) }}">{{ $category->category }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Search Bar -->
        <div style="max-width: 300px">
            <form action="/" method="GET" class="input-group">
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
