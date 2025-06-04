<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Add New Product</title>
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

        <div class="container mt-5">
            <div class="card shadow rounded p-4">
                <h2 class="mb-4 text-center text-primary">Add New Product</h2>
                <form method="POST" action="{{ url('/product-submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" step="0.01" required>
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Product Category</label>
                        <select name="category" class="form-select" required>
                            <option value="" disabled selected>Select a Category</option>

                            <optgroup label="Men">
                                <option value="men-topwear">Topwear</option>
                                <option value="men-bottomwear">Bottomwear</option>
                                <option value="men-sportswear">Sportswear</option>
                                <option value="men-ethnic">Ethnic</option>
                            </optgroup>
                            <optgroup label="Women">
                                <option value="women-topwear">Topwear</option>
                                <option value="women-bottomwear">Bottomwear</option>
                                <option value="women-sportswear">Sportswear</option>
                                <option value="women-ethnic">Ethnic</option>
                            </optgroup>
                            <optgroup label="Kids">
                                <option value="kids-topwear">Topwear</option>
                                <option value="kids-bottomwear">Bottomwear</option>
                                <option value="kids-sportswear">Sportswear</option>
                                <option value="kids-ethnic">Ethnic</option>
                            </optgroup>
                        </select>
                    </div>


                    <div class="mb-4">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success px-4 py-2">
                            <i class="fas fa-plus me-2"></i> Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>