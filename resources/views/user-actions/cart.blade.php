<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Everwoven</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ url('/') }}" class="navbar-brand">
                <h1 class="text-primary display-6">Everwoven</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>

            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    @foreach (['Men', 'Women', 'Kids'] as $category)
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{ $category }}</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="{{ url('/cart') }}" class="dropdown-item">Top Wear</a>
                            <a href="{{ url('/cart') }}" class="dropdown-item">Bottom Wear</a>
                            <a href="{{ url('/cart') }}" class="dropdown-item">Ethnic</a>
                            <a href="{{ url('/cart') }}" class="dropdown-item">Sportswear</a>
                        </div>
                    </div>
                    @endforeach

                    <a href="{{ url('/contact') }}" class="nav-item nav-link">Contact</a>
                    <a href="{{ url('/') }}" class="nav-item nav-link">About Us</a>
                </div>

                <div class="d-flex align-items-center gap-3 ms-auto me-3">
                    @if(session('session_firstname'))
                    <span class="fw-medium text-primary">
                        Hi,
                        <a href="{{ url('/display') }}" class="fw-medium text-primary" title="View Account Details">
                            {{ session('session_firstname') }}
                        </a>
                    </span>
                    <span class="fw-medium">
                        <a class="text-danger" href="{{ url('/logout') }}" title="Logout">
                            <i class="fas fa-sign-out-alt fa-lg text-danger"></i>
                        </a>
                    </span>
                    @else
                    <a href="{{ url('/login') }}" class="text-decoration-none text-primary">
                        <span class="fw-medium">Login</span>
                    </a>
                    <a href="{{ url('/seller-portal') }}" class="text-decoration-none text-primary">
                        <span class="fw-medium">Seller Portal</span>
                    </a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">My Cart</h1>
    </div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price (₹)</th>
                            <th>Quantity</th>
                            <th>Total (₹)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($selected_products as $product)
                        <tr>
                            <td><img src="{{ $product->image }}" height="130px" width="100px" alt="{{ $product->name }}"></td>
                            <td>{{ $product->name }}</td>
                            <td>₹{{ number_format($product->price, 2) }}</td>
                            <td>{{ $quantities[$product->product_id] ?? 1 }}</td>
                            <td>₹{{ number_format($product->price * ($quantities[$product->product_id] ?? 1), 2) }}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-danger mb-1">
                                    <i class="fas fa-trash-alt me-1"></i>Remove from Cart
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
            </div>
            @php
            $subtotal = 0;
            $shipping = 100;
            @endphp

            @foreach ($selected_products as $product)
            @php
            $quantity = $quantities[$product->product_id] ?? 1;
            $subtotal += $product->price * $quantity;
            @endphp
            @endforeach

            @php
            $isFreeShipping = $subtotal >= 1000;
            $total = $isFreeShipping ? $subtotal : $subtotal + $shipping;
            @endphp

            <div class="row justify-content-end">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="border rounded p-4 bg-white shadow-sm">
                        <h4 class="mb-4">Cart Total</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>₹{{$subtotal}}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span>₹{{ $isFreeShipping ? '0' : $shipping }}</span>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-3 mt-3 fw-semibold">
                            <span>Total:</span>
                            <span>₹{{ $total }}</span>
                        </div>
                        <a href="{{ url('/checkout') }}">
                            <button class="btn btn-outline-primary w-100 mt-4">Proceed to Checkout</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Everwoven</h1>
                            <p class="text-secondary mb-0">Fashion That Endures</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Love Us</h4>
                        <p class="mb-4">
                            At Everwoven, we blend timeless design with modern comfort. Our customers trust us for quality craftsmanship, sustainable fabrics, and styles that empower self-expression—season after season.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="{{url('/display')}}">My Account</a>
                        <a class="btn-link" href="{{url('/cart')}}">My Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Kolkata, India</p>
                        <p>Email: contact@everwoven.com</p>
                        <p>Phone: +919748141160</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Everwoven</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed By <a class="border-bottom" href="">Everwoven</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>