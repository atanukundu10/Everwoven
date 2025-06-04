<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-wrapper {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
            margin-top: 4rem;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="form-wrapper w-100" style="max-width: 500px;">
            <h3 class="text-center text-primary mb-4">Change Password</h3>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
            @endif
            <form method="POST" action="{{ url('/change_password') }}">
                @csrf

                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Update Password</button>
            </form>
            <a href="{{ url('/') }}" class="btn btn-outline-success btn-block mt-3">Back to Home</a>
        </div>
    </div>
</body>

</html>