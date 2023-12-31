<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

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