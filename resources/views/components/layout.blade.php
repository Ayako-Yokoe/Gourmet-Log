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
<body class="flex">
    {{-- @auth --}}
        @include('components.sidebar')
    {{-- @else --}}
        {{-- @include('components.navbar') --}}
    {{-- @endauth --}}

{{-- 
    may need to change the flex or by auth --}}
    <main class="flex-1">
        <div>
        {{-- <h1>Hello</h1>  --}}
        @yield('main')
        </div>

    </main>
</body>
</html>