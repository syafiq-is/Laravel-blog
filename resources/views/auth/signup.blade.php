<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up</title>
    <link rel="shortcut icon" href="laravel.png" type="image/x-icon">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.bundle.min.js"></script>
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="/font/bootstrap-icons.css">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="index.css" />
</head>

<body data-bs-theme="dark" class="d-flex justify-content-center align-items-center overflow-hidden"
    style="height: 100vh">
    <div class="card bg-navbar p-2" style="width: 400px">
        <div class="card-body">
            <h3 class="text-center fw-bold mb-4">Sign up</h3>
            @error('error')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            <form action="signup" method="POST" class="vstack gap-3">
                @csrf

                <div>
                    <input class="form-control @error('username') is-invalid @enderror" type="text"
                        placeholder="Username" name="username" value="{{ old('username') }}" />
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Email"
                        name="email" value="{{ old('email') }}" />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <input class="form-control @error('password') is-invalid @enderror" id="passwordInput"
                        type="password" placeholder="Password" name="password" />
                    <button class="btn btn-outline-secondary rounded-end" onclick="toggleEye(event)">
                        <i class="bi bi-eye"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-brand" type="submit">Sign up</button>
                <div class="text-center">
                    Already have an account?
                    <a href="login" class="text-brand hover-underline">Log in</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle Password Visiblity
        function toggleEye(e) {
            e.preventDefault();

            var x = document.getElementById("passwordInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>
