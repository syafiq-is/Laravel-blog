<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="laravel.png" type="image/x-icon">
    <title>Home</title>
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="/font/bootstrap-icons.css">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="index.css" />
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

            <div class="d-flex gap-2">
                <a href="signup" class="btn btn-outline-brand">Sign up</a>
                <a href="login" class="btn btn-outline-brand">Log in</a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->


    <!-- Content -->
    <main class="container-lg p-4">
        <h2 class="fw-bold my-4">All Posts</h2>

        @include('partials.posts-list', ['posts' => $posts])
    </main>
    <!-- End Content -->
</body>

</html>
