

<!DOCTYPE html>
<!--
* CoreUI Pro - Bootstrap Admin Template
* @version v2.1.14
* @link https://coreui.io/pro/
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* License (https://coreui.io/pro/license)
-->

<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Pro Bootstrap Admin Template</title>
    <!-- Styles -->
    <link href="{{ URL::asset('public/template/back/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/template/back/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/template/back/vendors/fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/template/back/vendors/fontawesome/css/solid.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/template/back/vendors/fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/template/back/vendors/fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/template/back/vendors/flag-icon-css/css/flag-icon.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/template/back/vendors/simple-line-icons/simple-line-icons.css') }}" rel="stylesheet">
</head>

<body class="app flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">

                            <form method="POST" action="{{ url('/login') }}">
                                @csrf

                                @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                                @endif


                                <h1>Login</h1>
                                <p class="text-muted">Sign In to your account</p>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <span>@</span>

                                        </span>
                                    </div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $email }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="icon-lock"></i>
                                        </span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $password }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="submit">Login</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <h2>Sign up</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <button onclick="location.href='{{url('/register')}}';" class="btn btn-primary active mt-3" type="submit">Register Now!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ URL::asset('public/template/back/js/app.js')}}"></script>
</body>

</html>