<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>View All User Details</title>
    <style>
        .button-group {
            max-width: 600px;
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .button-group .btn {
            font-size: 1rem;
            padding: 0.75rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl shadow-sm">
            <div class="container-fluid d-flex align-items-center justify-content-between px-4">
                <a href="{{ url('/') }}" class="navbar-brand ps-2">
                    <h1 class="text-primary display-6 mb-0 fw-bold">Everwoven</h1>
                </a>
                <div class="d-flex align-items-center gap-3 pe-2">
                    @if(session()->has('session_seller_fullname'))
                    <span class="fw-medium text-primary">
                        Hi, {{ session('session_seller_fullname') }}
                    </span>
                    <a class="text-danger" href="{{ url('/seller-logout') }}" title="Logout">
                        <i class="fas fa-sign-out-alt fa-lg text-danger"></i>
                    </a>
                    @endif
                </div>
            </div>
        </nav>

        <div class="button-group text-center">
            <a href="{{ url('/seller-business-details') }}" class="btn btn-outline-primary">
                <i class="fas fa-briefcase me-2"></i> My Business Details
            </a>
            <a href="{{ url('/add-new-product') }}" class="btn btn-outline-secondary">
                <i class="fas fa-plus me-2"></i> Add New Product
            </a>
            <a href="{{ url('/seller-orders') }}" class="btn btn-outline-success">
                <i class="fas fa-box me-2"></i> My Orders
            </a>
            <a href="{{ url('/seller-view-products') }}" class="btn btn-outline-warning">
                <i class="fas fa-tags me-2"></i> View My Products
            </a>
            <a href="{{ url('/contact-admin') }}" class="btn btn-outline-info">
                <i class="fas fa-headset me-2"></i> Contact Admin
            </a>
            <!-- New Add Product Button -->
        </div>
    </div>
</body>

</html>