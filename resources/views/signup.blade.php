<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous" />
    <style>
        body {
            background-image: url('https://t4.ftcdn.net/jpg/05/96/62/65/360_F_596626503_jrzjZNYStDexiWxQFqO7oCh6M8PdMlJs.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
        }

        .form-wrapper {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    @if(session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif
    <div class="d-flex justify-content-center align-items-center">
        <div class="w-100" style="max-width: 500px;">
            <form class="form-wrapper" method="post" action="{{url('/submit')}}">
                @csrf
                <h3 class="text-center mb-4 text-primary">Sign Up</h3>

                <div class="form-group">
                    <input type="text" name="firstname" class="form-control" placeholder="First Name" />
                </div>

                <div class="form-group">
                    <input type="text" name="middlename" class="form-control" placeholder="Middle Name" />
                </div>

                <div class="form-group">
                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" />
                </div>

                <div class="form-group">
                    <input type="number" name="age" class="form-control" placeholder="Age"/>
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" />
                </div>

                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Phone Number" />
                </div>

                <div class="form-group">
                    <div class="border rounded px-3 py-2">
                        <label class="d-block mb-2 font-weight-bold">Gender</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="genderMale" name="gender" class="custom-control-input" value="male">
                            <label class="custom-control-label" for="genderMale">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="genderFemale" name="gender" class="custom-control-input" value="female">
                            <label class="custom-control-label" for="genderFemale">Female</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="genderOther" name="gender" class="custom-control-input" value="other">
                            <label class="custom-control-label" for="genderOther">Other</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" />
                </div>

                <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" />
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="terms_check" />
                    <label class="form-check-label" for="terms_check">
                        I agree to the terms and conditions.
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            </form>
        </div>
    </div>
</body>

</html>