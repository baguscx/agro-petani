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
                    <div class="mb-4 text-sm text-light">
                        {{ __('Lupa password? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan tautan reset password melalui email yang akan memungkinkan Anda memilih yang baru.') }}
                    </div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4 alert alert-info" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="btn btn-primary">
                                {{ __('Reset Password') }}
                            </x-primary-button>
                        </div>

                        <a class="btn btn-sm btn-success" href="{{route('login')}}">⬅️Back</a>
                    </form>
            </div>
        </div>
    </div>
</x-guest-layout>
</body>
</html>
