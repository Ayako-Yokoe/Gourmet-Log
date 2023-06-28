@extends('components.layout')

@section('main')

{{-- @unless (count($restaurants == 0)) --}}

<div class="w-10/12 mx-auto mt-20">
    <h1 class="text-lg font-bold my-4">Restaurant List</h1> 
    
    {{-- Search Restaurant --}}
    <div class="my-4">
        <form>
            <input 
                type="text" 
                placeholder="Enter a name of a restaurant" 
                class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-1/4" 
                />
            <button 
                type="submit"
                class="border border-gray-400 bg-gray-300 rounded-lg mt-2 px-2 py-1"
            >
                Search
            </button>
        </form>
    </div>

    {{-- Show Restaurant List --}}
    <div>

        <p class="my-4">1-10/50</p>

        <table class="table-auto w-full text-center">
            <thead>
                <tr>
                    <th class="border border-slate-300 py-4 px-2">id</th>
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
                @foreach ($restaurants as $restaurant)
                    
                <tr class="px-4">
                    <td class="border border-slate-300">{{ $restaurant->id }}</td>
                    <td class="border border-slate-300">{{ $restaurant->name }}</td>
                    <td class="border border-slate-300">category</td>
                    <td class="border border-slate-300">{{ $restaurant->review }}</td>
                    <td class="border border-slate-300">{{ $restaurant->comment }}</td>
                    <td class="border border-slate-300">
                        <a href="/restaurants/{{ $restaurant->id }}">
                        <span class="bg-green-700 text-white rounded-xl px-3 py-1 my-2 hover:text-green-700 hover:bg-white border-2 border-green-700">
                            Detail
                        </span>
                        </a>
                    </td>
                    <td class="border border-slate-300">
                        <a href="/restaurants/{{ $restaurant->id }}">
                        <span class="bg-blue-700 text-white rounded-xl px-3 py-1 hover:text-blue-700 hover:bg-white border-2 border-blue-700">
                            Edit
                        </span>
                        </a>
                    </td>
                    <td class="border border-slate-300">
                        <button class="bg-red-700 text-white rounded-xl px-3 py-1 hover:text-red-700 hover:bg-white border-2 border-red-700">
                            Delete
                        </button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <p class="my-6">'<'1 2  3''>'</p>
    </div>
</div>





{{-- @else
<p>No restaurants</p>

@endunless --}}

@endsection