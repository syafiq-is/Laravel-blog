@extends('layouts.app')

@section('title', 'Profile: edit')

@section('content')
    <form enctype="multipart/form-data" action="/users/{{ auth()->user()->id }}" method="POST" class="vstack gap-3 m-auto"
        style="width: 500px">
        @csrf
        @method('PATCH')
        <div class="d-flex flex-column align-items-center">
            <img class="rounded-circle object-fit-cover" src="/storage/{{ $user->profile_img }}"
                style="width: 150px; aspect-ratio: 1; outline: 1px solid gray" id="output" />
            <div>
                <input type="file" accept="image/*" style="display: none" name="profile_img" id="changePic"
                    onchange="loadFile(event)" />
                <label for="changePic" class="text-brand hover-underline text-center" style="cursor: pointer">
                    Change photo
                </label>
            </div>
        </div>

        <div class="border border-secondary p-4 rounded">
            <div class="d-flex justify-content-between align-items-center">
                <div class="w-100">
                    <p class="mb-0 fw-bold text-brand">Username</p>
                    <input class="mb-0 form-control" value="{{ $user->username }}" name="username" />
                </div>
            </div>
            <hr />
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 fw-bold text-brand">Email</p>
                    <p class="mb-0">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-brand w-100">Save</button>

        @error('username')
            <div class="alert alert-danger w-100">{{ $message }}</div>
        @enderror
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
