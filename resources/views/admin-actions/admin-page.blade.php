<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Admin Actions</title>
    <style>
        .admin-buttons {
            max-width: 600px;
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .admin-buttons button {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <div class="container-fluid d-flex align-items-center justify-content-between px-4">
                <a href="{{ url('/') }}" class="navbar-brand ps-2">
                    <h1 class="text-primary display-6 mb-0">Everwoven</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                    <div class="navbar-nav text-center">
                        @foreach (['Men', 'Women', 'Kids'] as $category)
                        <div class="nav-item dropdown px-2">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ $category }}</a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{ url('/cart') }}" class="dropdown-item">Top Wear</a>
                                <a href="{{ url('/cart') }}" class="dropdown-item">Bottom Wear</a>
                                <a href="{{ url('/cart') }}" class="dropdown-item">Ethnic</a>
                                <a href="{{ url('/cart') }}" class="dropdown-item">Sportswear</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 pe-2">
                    @if(session()->has('session_admin_name'))
                    <span class="fw-medium text-primary">
                        Hi, <a href="{{ url('/#')}}" class="fw-medium text-primary" title="View Account Details">{{ session('session_admin_name') }}</a>
                    </span>
                    <span class="fw-medium">
                        <a class="text-danger" href="{{ url('/admin-logout') }}" title="Logout">
                            <i class="fas fa-sign-out-alt fa-lg text-danger"></i>
                        </a>
                    </span>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <div class="admin-buttons">
        <a href="{{url('/admin-display')}}">
            <button class="btn btn-outline-primary">
                <i class="fas fa-users me-2"></i> Show All Users
            </button>
        </a>
        <a href="{{url('/admin-show-sellers')}}">
            <button class="btn btn-outline-dark">
                <i class="fas fa-store me-2"></i> Show All Sellers
            </button>
        </a>
        <button class="btn btn-outline-success">
            <i class="fas fa-receipt me-2"></i> Show All Orders
        </button>
        <a href="{{url('/admin-show-all-items')}}">
            <button class="btn btn-outline-warning">
                <i class="fas fa-box-open me-2"></i> Show All Items
            </button>
        </a>
        <a href="{{url('/admin-approve-seller')}}">
            <button class="btn btn-outline-info">
                <i class="fas fa-check-circle me-2"></i> Approve/Reject Seller Applications
            </button>
        </a>
    </div>

</body>

</html>