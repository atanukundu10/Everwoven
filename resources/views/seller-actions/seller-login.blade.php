<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seller Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light d-flex flex-column vh-100">
    <div class="container-fluid px-0">
        <nav class="navbar navbar-light bg-white shadow-sm navbar-expand-xl">
            <div class="container-fluid d-flex align-items-center justify-content-between px-4">
                <a href="{{ url('/') }}" class="navbar-brand ps-2 d-flex align-items-center">
                    <h1 class="text-primary display-6 mb-0 fw-bold">Everwoven</h1>
                </a>
            </div>
        </nav>
    </div>

    <div class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="container" style="max-width: 400px;">
            <div class="card shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-center text-primary">Seller Login</h3>

                    @if(session('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{url('/seller-signin')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Don't have an account?
                            <a href="{{ url('/seller-signup') }}" class="text-decoration-none">Sign up</a>
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>