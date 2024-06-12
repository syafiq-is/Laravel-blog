@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <h2>Category</h2>

    <form action="{{ route('createCategory') }}" method="POST" class="input-group mt-4">
        @csrf
        <input type="text" name="category" placeholder="Enter new category" class="form-control" />
        <button class="btn btn-brand" type="submit">Add Category</button>
    </form>

    <!-- Categories Table -->
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="fw-bold" style="line-height: 40px">Categories List</div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover m-0">
                <thead>
                    <tr>
                        <th scope="col" style="width: 50px">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->category }}</td>
                            <td>
                                <form action="{{ route('deleteCategory', ['id' => $category->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button href="{{ route('deleteCategory', ['id' => $category->id]) }}"
                                        class="btn p-0 text-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Categories Table -->
@endsection
