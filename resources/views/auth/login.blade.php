<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | EVERTONE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Modernize Login Page">
    <link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
    <link id="themeColors" rel="stylesheet" href="{{ asset('assets/dist/css/style.min.css') }}" />
</head>
<body>
    <div class="page-wrapper min-vh-100 d-flex align-items-center justify-content-center radial-gradient">
        <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <a href="javascript:void(0)" class="text-center d-block mb-5">
                        <img src="{{ asset('assets/dist/images/profile/logo.png') }}" width="180" alt="Modernize Logo">
                    </a>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"  autofocus autocomplete="username">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control"  autocomplete="current-password">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        {{-- <div class="d-flex justify-content-between mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label" for="remember_me">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-primary" href="{{ route('password.request') }}">Forgot Password?</a>
                            @endif
                        </div> --}}
                        <button type="submit" class="btn btn-primary w-100 py-2">Log in</button>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/app.min.js') }}"></script>
</body>
</html>
