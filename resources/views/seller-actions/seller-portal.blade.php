<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            font-size: 1rem;
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 123, 255, 0.15);
        }

        .card-style {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="bg-light vh-100 d-flex flex-column">
    <div class="container-fluid px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <div class="container-fluid d-flex align-items-center justify-content-between px-4">
                <a href="{{ url('/') }}" class="navbar-brand ps-2">
                    <h1 class="text-primary display-6 mb-0 fw-bold">Everwoven</h1>
                </a>
            </div>
        </nav>
    </div>
    <div class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="card-style text-center col-10 col-sm-8 col-md-6 col-lg-4">
            <h1 class="mb-2">Welcome to the Seller Portal</h1>
            <p class="text-muted mb-4">Manage your listings, orders, and performance.</p>

            <div class="d-grid gap-3">
                <a href="{{ url('/seller-login') }}" class="btn btn-primary btn-custom">
                    <i class="fas fa-sign-in-alt me-2"></i> Login as a Seller
                </a>
                <a href="{{ url('/seller-signup') }}" class="btn btn-outline-primary btn-custom">
                    <i class="fas fa-user-plus me-2"></i> Sign Up as a Seller
                </a>
            </div>

            <p class="mt-4 small text-muted">Need help? <a href="{{url('/contact')}}">Contact Support</a></p>
        </div>
    </div>
</body>

</html>