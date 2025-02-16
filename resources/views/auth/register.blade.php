<!DOCTYPE html>
<html lang="id">
<head>
    <title>Registrasi | Modernize</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Halaman Registrasi Modernize">
    <link rel="shortcut icon" type="image/png" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
    <link id="themeColors" rel="stylesheet" href="{{ asset('assets/dist/css/style.min.css') }}" />
</head>
<body>
    <div class="page-wrapper min-vh-100 d-flex align-items-center justify-content-center radial-gradient">
        <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <a href="index-2.html" class="text-center d-block mb-5">
                        <img src="{{ asset('assets/dist/images/profile/logo.png') }}" width="180" alt="Modernize Logo">
                    </a>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input id="name" class="form-control" type="text" name="name" :value="old('name')" autofocus autocomplete="name">
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Alamat Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')" autocomplete="username">
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Kata Sandi -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input id="password" class="form-control" type="password" name="password" autocomplete="new-password">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Konfirmasi Kata Sandi -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" autocomplete="new-password">
                            {{-- @error('password') <small class="text-danger">{{ $message }}</small> @enderror --}}
                        </div>

                        <!-- Tombol Kirim -->
                        <button type="submit" class="btn btn-primary w-100 py-2">Daftar</button>
                    </form>
                    <div class="mt-3 text-center">
                        <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Masuk di sini</a></p>
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
