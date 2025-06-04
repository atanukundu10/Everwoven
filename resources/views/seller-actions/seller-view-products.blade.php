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
        .table-container {
            max-width: 95%;
            margin: 2rem auto;
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
                <div class="d-flex align-items-center gap-3 pe-2">
                    @if(session()->has('session_seller_fullname'))
                    <span class="fw-medium text-primary">
                        Hi, <a href="{{ url('/#')}}" class="fw-medium text-primary" title="View Account Details">{{ session('session_seller_fullname') }}</a>
                    </span>
                    <span class="fw-medium">
                        <a class="text-danger" href="{{ url('/seller-logout') }}" title="Logout">
                            <i class="fas fa-sign-out-alt fa-lg text-danger"></i>
                        </a>
                    </span>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    @if(isset($all_products))
    <div class="table-container">
        <h3 class="text-center mb-4">All Product Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_products->all() as $all)
                    <tr>
                        <td>{{ $all->product_id }}</td>
                        <td>{{ $all->name }}</td>
                        <td>{{ $all->description }}</td>
                        <td>{{ $all->price }}</td>
                        <td><img src="{{$all->image}}" alt="" height="25px" width="40px"></td>
                        <td>{{ $all->quantity }}</td>
                        <td>{{ $all->category }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-primary mb-1">
                                <i class="fas fa-edit me-1"></i>Update Quantity
                            </a>
                            <a href="" class="btn btn-sm btn-danger mb-1">
                                <i class="fas fa-trash-alt me-1"></i>Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</body>

</html>