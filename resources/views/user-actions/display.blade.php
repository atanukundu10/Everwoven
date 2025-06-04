@php
use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl shadow-sm py-3">
            <div class="container-fluid d-flex align-items-center justify-content-between px-4">
                <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center ps-2">
                    <h1 class="text-primary fw-bold display-6 mb-0" style="letter-spacing: 1px;">Everwoven</h1>
                </a>
            </div>
        </nav>
    </div>

    @if (session('message'))
    <div class="alert alert-info text-center">
        {{ session('message') }}
    </div>
    @endif

    @if(isset($user))
    <div class="container-xl px-4 mt-5">
        <div class="row">
            <div class="col-xl-8 offset-xl-2">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white fw-bold">
                        Account Information
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Name:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Gender:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ Str::ucfirst($user->gender) }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Age:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">
                                    {{ $user->age }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Email:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Phone:</label>
                            <div class="col-sm-8">
                                <p class="form-control-plaintext">{{ $user->phone }}</p>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                            <a href="{{ url('/edit') }}" class="btn btn-outline-primary">Edit Details</a>
                            <a href="{{ url('/changepassword') }}" class="btn btn-outline-secondary">Change Password</a>
                            <a href="{{ url('/request-account-deletion') }}" class="btn btn-outline-danger">Request Account Deletion</a>
                            <a href="{{ url('/') }}" class="btn btn-outline-success">Back to Home</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</body>

</html>