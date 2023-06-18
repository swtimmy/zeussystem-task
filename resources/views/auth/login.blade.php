<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/jQuery.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/jQuery.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100">
<div class="w-full mx-auto h-[100vh]">
    <div class="flex justify-center mt-20">
        <div class="w-full max-w-sm">
            <div class="bg-white shadow-md rounded px-8 py-6">
                <div class="text-center mb-6">
                    <h1 class="text-xl font-semibold">{{ __('Login') }}</h1>
                </div>

                <form method="POST" action="{{ route('login') }}" class="w-full">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Email Address') }}
                        </label>

                        <input id="email" type="email" class="w-full @error('email') border-red-500 @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Password') }}
                        </label>

                        <input id="password" type="password" class="w-full @error('password') border-red-500 @enderror"
                               name="password" required autocomplete="current-password">

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center">
                            <input class="mr-2" type="checkbox" name="remember" id="remember"
                                   {{ old('remember') ? 'checked' : '' }}>

                            <label class="text-sm text-gray-700" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request') && false)
                            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                               href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>

                <div class="py-6">
                    <div class="group">
                        <h4 class="text-md">Admin Account:</h4>
                        <h5 class="text-sm">swtimmy9166@gmail.com</h5>
                        <h4 class="text-md">Technician Account:</h4>
                        <h5 class="text-sm">technician@gmail.com</h5>
                        <h4 class="text-md">Regular Account:</h4>
                        <h5 class="text-sm">regular@gmail.com</h5>
                        <br>
                        <h5 class="text-md">Password for support accounts:</h5>
                        <h5 class="text-sm">password</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>