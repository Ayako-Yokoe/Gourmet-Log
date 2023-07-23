<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ mix('js/form.js') }}"></script> --}}

    <title>Gourmet Log</title>
</head>
<body>
    <main>
        @auth
            <div class="flex">
                @include('components.sidebar', ['userName' => Auth::user()->name])
                @yield('main')
            </div>
        @else

        <div class="flex flex-col h-screen">
            @include('components.navbar')
            @yield('main')
        </div>
        @endauth
    </main>
</body>
</html>



{{-- 
To Do
- Add astarisk to input field 
- Error handling: 'max:10'etc
- Categories <--> user ? not related
--}}