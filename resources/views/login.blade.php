<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            background-image: url('https://t4.ftcdn.net/jpg/05/96/62/65/360_F_596626503_jrzjZNYStDexiWxQFqO7oCh6M8PdMlJs.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .login-wrapper {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    @if(session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-wrapper" style="width: 100%; max-width: 400px;">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <p class="text-center mb-4 text-primary h4">Log In</p>
                    <form class="form-wrapper" method="post" action="{{url('/signin')}}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter email" />
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter password" />
                        </div>

                        <div class="text-center mb-4">
                            <a href="#!">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg mb-4">Sign in</button>
                        <a href="{{ url('/') }}" class="btn btn-success btn-block btn-lg mb-4">
                            Back To Home
                        </a>

                        <div class="text-center">
                            <p>Not a member? <a href="{{url('/signup')}}">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>