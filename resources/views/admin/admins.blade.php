@extends('layouts.app')

@section('title', 'Admins')

@section('content')
    <h2>Admin</h2>

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
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">isAdmin</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->isAdmin }}</td>
                            @if ($user->id !== 1)
                                <form action="{{ route('toggleAdmin', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if ($user->isAdmin)
                                        <td>
                                            <button type="submit" class="text-danger btn p-0"> Revoke admin </button>
                                        </td>
                                    @else
                                        <td>
                                            <button type="submit" class="text-success btn p-0"> Grant admin </button>
                                        </td>
                                    @endif
                                </form>
                            @else
                                <td>
                                    <p class="m-0"> - </p>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
