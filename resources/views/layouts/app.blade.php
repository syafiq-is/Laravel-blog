<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" href="/img/Laravel.png" type="image/x-icon" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Bootstrap Font Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/index.css" />
</head>

<body data-bs-theme="dark">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" style="height: 60px">
        <div class="container-lg">
            <a class="navbar-brand" href="/">
                <img src="/img/Laravel.png" alt="logo" width="30" height="30"
                    class="d-inline-block align-text-top me-1" />
                Blog
            </a>

            <div>
                <a href="/profile/{{ auth()->user()->id }}" class="d-flex gap-2">
                    <div class="d-flex align-items-center">{{ auth()->user()->username }}</div>
                    <div class="dropdown-center">
                        <img class="rounded-circle object-fit-cover" src="/storage/{{ auth()->user()->profile_img }}"
                            style="width: 40px; aspect-ratio: 1; outline: 1px solid gray" />
                    </div>
                </a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-lg d-flex">
        <!-- Sidebar -->
        <div class="flex-shrink-0 p-3 border-end" style="width: 250px; height: 100vh; position: fixed; top: 60px">
            <div class="my-2">
                <div class="p-2 text-secondary fw-bold">USER</div>
                <div>
                    <a href="/" class="text-hover-brand">
                        <div class="p-2 w-100">
                            <i class="bi bi-house me-1"></i>
                            Home
                        </div>
                    </a>
                    <a href="/profile/{{ auth()->user()->id }}" class="text-hover-brand">
                        <div class="p-2 w-100">
                            <i class="bi bi-person me-1"></i>
                            Profile
                        </div>
                    </a>
                    <a href="/post-create" class="text-hover-brand">
                        <div class="p-2 w-100">
                            <i class="bi bi-plus-circle me-1"></i>
                            Create post
                        </div>
                    </a>
                </div>
            </div>

            @can('admin', auth()->user()->is_admin)
                <div class="my-2">
                    <div class="p-2 text-secondary fw-bold">ADMIN</div>
                    <div class="">
                        <a href="/categories" class="text-hover-brand">
                            <div class="p-2 w-100">
                                <i class="bi bi-tag me-1"></i>
                                Category
                            </div>
                        </a>
                    </div>
                </div>
            @endcan

            @can('super-admin', auth()->user()->is_admin)
                <div class="my-2">
                    <div class="p-2 text-secondary fw-bold">SUPER ADMIN</div>
                    <div>
                        <a href="/admins" class="text-hover-brand">
                            <div class="p-2 w-100">
                                <i class="bi bi-person-lock me-1"></i>
                                Admin
                            </div>
                        </a>
                    </div>
                </div>
            @endcan

            <div class="my-2">
                <div class="p-2 text-secondary fw-bold">LOG OUT</div>
                <div>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="text-hover-brand btn p-0"
                            onclick="return confirm('Are you sure you want to logout?')">
                            <div class="p-2 w-100">
                                <i class="bi bi-box-arrow-right me-1"></i>
                                Log out
                            </div>
                        </button>
                    </form>
                    <form action="/users/{{ auth()->user()->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-hover-brand btn p-0"
                            onclick="return confirm('Are you sure you want to delete this user and all associated posts?')">
                            <div class="p-2 w-100">
                                <i class="bi bi-trash me-1"></i>
                                Delete account
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Content -->
        <main class="p-5 w-100" style="margin-left: 250px">
            @yield('content')
        </main>
        <!-- End Content -->
    </div>

</body>

</html>
