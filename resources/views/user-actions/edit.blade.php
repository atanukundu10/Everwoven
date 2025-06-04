<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Account</title>
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
            margin-top: 4rem;
        }
    </style>
</head>

<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="d-flex justify-content-center align-items-start">
        <div class="w-100" style="max-width: 500px;">
            <form class="form-wrapper" method="POST" action="{{ url('/save_changes') }}">
                @csrf
                <h3 class="text-center mb-4 text-primary">Edit Details</h3>

                <div class="form-group">
                    <input type="text" name="user_id" class="form-control" value="{{ $user->user_id }}" required hidden>
                </div>

                <div class="form-group">
                    <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}" required>
                </div>

                <div class="form-group">
                    <input type="text" name="middlename" class="form-control" value="{{ $user->middlename }}">
                </div>

                <div class="form-group">
                    <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}" required>
                </div>

                <div class="form-group">
                    <input type="number" name="age" class="form-control" value="{{ $user->age }}" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" value="{{ $user->phone }}" required>
                </div>

                <div class="form-group">
                    <div class="border rounded px-3 py-2">
                        <label class="d-block mb-2 font-weight-bold">Gender</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="genderMale" name="gender" class="custom-control-input" value="male" {{ $user->gender == 'male' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="genderMale">Male</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="genderFemale" name="gender" class="custom-control-input" value="female" {{ $user->gender == 'female' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="genderFemale">Female</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="genderOther" name="gender" class="custom-control-input" value="other" {{ $user->gender == 'other' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="genderOther">Other</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-3">Save Changes</button>
                <a href="{{ url('/') }}" class="btn btn-outline-success btn-block mt-3">Back to Home</a>
            </form>
            
        </div>
    </div>
</body>

</html>