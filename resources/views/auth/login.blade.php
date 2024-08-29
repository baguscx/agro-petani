<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->

	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="{{asset('login.css')}}">
</head>
<body>
    <x-guest-layout>
    <!-- Centered Container -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6 col-lg-4">
            <!-- Background -->
            <div class="card shadow-sm p-4" style="background-color: #f8f9fa; border-radius: 10px;">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4 alert alert-info" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" class="form-label text-light" />
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="invalid-feedback" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <x-input-label for="password" :value="__('Password')" class="form-label text-light" />
                        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="invalid-feedback" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-3">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label text-light">
                            {{ __('Ingat saya') }}
                        </label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a class="btn btn-sm btn-primary text-sm text-decoration-none text-white font-weight-bold" href="{{ route('password.request') }}">
                                {{ __('Lupa Kata Sandi?') }}
                            </a>
                        @endif

                        <x-primary-button class="btn btn-primary">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>

                    <br> <br>

                    <div class="dzz-flex text-light justify-content-between align-items-center">
                        Belum Punya Akun?
                            <a class="btn btn-primary text-sm text-decoration-none text-white font-weight-bold" href="{{ route('register') }}">
                                {{ __('Buat Akun') }}
                            </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
</body>
</html>
