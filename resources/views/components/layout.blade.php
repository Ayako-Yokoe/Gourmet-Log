<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
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
        {{-- <h1>Hello</h1> --}}
        {{-- @yield('main') --}}
        </div>


        {{-- 
            Restaurants List
            Create Routes/Controllers 
        --}}

        <div>
            <h1>Restaurant List</h1>
        {{-- Search Restaurant --}}
        <div>
            <form>
                <input type="text" placeholder="Enter a name of a restaurant" />
                <button type="submit">Search</button>
            </form>
        </div>

        {{-- Show Restaurant List --}}
        <div>


        </div>
        <p>1-10/50</p>
        <table class="table-auto w-full text-center">
            <thead>
                <tr>
                    <th class="border border-slate-300">id</th>
                    <th class="border border-slate-300">name</th>
                    <th class="border border-slate-300">category</th>
                    <th class="border border-slate-300">review</th>
                    <th class="border border-slate-300">comment</th>
                    <th class="border border-slate-300">detail</th>
                    <th class="border border-slate-300">edit</th>
                    <th class="border border-slate-300">delete</th>
                </tr>
            </thead>
            <tbody>
                <tr class="px-4">
                    <td class="border border-slate-300">1</td>
                    <td class="border border-slate-300">name</td>
                    <td class="border border-slate-300">category</td>
                    <td class="border border-slate-300">5</td>
                    <td class="border border-slate-300">comment</td>
                    <td class="border border-slate-300"><button class="bg-green-700 text-white rounded px-3 py-1 my-2 hover:text-green-700 hover:bg-white border-2 border-green-700">Detail</button></td>
                    <td class="border border-slate-300"><button class="bg-blue-700 text-white rounded px-3 py-1 hover:text-blue-700 hover:bg-white border-2 border-blue-700">Edit</button></td>
                    <td class="border border-slate-300"><button class="bg-red-700 text-white rounded px-3 py-1 hover:text-red-700 hover:bg-white border-2 border-red-700">Delete</button></td>
                </tr>
            </tbody>
        </table>
        <p>'<'1 2  3''>'</p>

        </div>





    </main>
</body>
</html>