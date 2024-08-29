

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

                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <x-input-label for="name" :value="__('Name')" class="form-label text-light" />
                        <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="invalid-feedback" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <x-input-label for="email" :value="__('Email')" class="form-label text-light" />
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="invalid-feedback" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <x-input-label for="password" :value="__('Password')" class="form-label text-light" />
                        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="invalid-feedback" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label text-light" />
                        <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="invalid-feedback" />
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn btn-sm btn-primary text-sm text-decoration-none text-light" href="{{ route('login') }}">
                            <strong>{{ __('Sudah Punya Akun?') }}</strong>
                        </a>

                        <x-primary-button class="btn btn-primary">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

</body>
</html>
