@extends('components.layout')

@section('main')

{{-- @unless (count($restaurants == 0)) --}}

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
                @foreach ($restaurants as $restaurant)
                    
                <tr class="px-4">
                    <td class="border border-slate-300">{{ $restaurant->id }}</td>
                    <td class="border border-slate-300">{{ $restaurant->name }}</td>
                    <td class="border border-slate-300">category</td>
                    <td class="border border-slate-300">{{ $restaurant->review }}</td>
                    <td class="border border-slate-300">{{ $restaurant->comment }}</td>
                    <td class="border border-slate-300">
                        <a href="/restaurants/{{ $restaurant->id }}">
                        <span class="bg-green-700 text-white rounded px-3 py-1 my-2 hover:text-green-700 hover:bg-white border-2 border-green-700">
                            Detail
                        </span>
                        </a>
                    </td>
                    <td class="border border-slate-300">
                        <a href="/restaurants/{{ $restaurant->id }}">
                        <span class="bg-blue-700 text-white rounded px-3 py-1 hover:text-blue-700 hover:bg-white border-2 border-blue-700">
                            Edit
                        </span>
                        </a>
                    </td>
                    <td class="border border-slate-300">
                        <button class="bg-red-700 text-white rounded px-3 py-1 hover:text-red-700 hover:bg-white border-2 border-red-700">
                            Delete
                        </button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <p>'<'1 2  3''>'</p>
    </div>
</div>





{{-- @else
<p>No restaurants</p>

@endunless --}}

@endsection