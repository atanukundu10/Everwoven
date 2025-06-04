<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seller Signup</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">Seller Signup</h3>

    <form action="{{ url('/seller-submit') }}" method="post">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" name="fullname" required />
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" required />
      </div>

      <div class="mb-3">
        <label for="gstin" class="form-label">GSTIN</label>
        <input type="text" class="form-control" name="gstin" placeholder="e.g.. 22AAAAA0000A1Z5" required />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required />
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </div>

      <p class="text-center mt-3 mb-0">
        Already have an account?
        <a href="{{ url('/seller-login') }}">Login</a>
      </p>
    </form>
  </div>

</body>

</html>
