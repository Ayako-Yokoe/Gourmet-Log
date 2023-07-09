@extends('components.layout')

@section('main')

{{-- @unless (count($restaurants == 0)) --}}

<div class="w-10/12 mx-auto mt-20">
    <h1 class="text-lg font-bold my-4">Restaurant List</h1> 
    
    {{-- Search Restaurant --}}
    <div class="my-4">
        <form method="GET" action="{{ route('restaurants.index') }}">
            <input 
                type="search"
                name="search"
                placeholder="Enter a name of a restaurant" 
                class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-1/4" 
                value="{{ request('search') }}"
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

        <div class="flex justify-end">
            <p class="my-4 mr-2">1-10/50</p>
        </div>

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
                    <td class="border border-slate-300">

                        {{-- Add Comma --}}
                        @foreach ($restaurant->categories as $category)
                            {{ $category->name }}
                        @endforeach
                    </td>
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
                        <a href="{{ route('restaurants.edit', ['id' => $restaurant->id] )}}">
                        <span class="bg-blue-700 text-white rounded-xl px-3 py-1 hover:text-blue-700 hover:bg-white border-2 border-blue-700">
                            Edit
                        </span>
                        </a>
                    </td>

                    <td class="border border-slate-300">
                        <form method="POST" action="/restaurants/{{$restaurant->id}}">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit"
                                class="bg-red-700 text-white rounded-xl px-3 py-1 hover:text-red-700 hover:bg-white border-2 border-red-700"
                                onclick="return confirm('本当に削除してもよろしいですか？')"
                            >
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>


        <div class="my-4">
            {{ $restaurants->render('components.pagination') }}
        </div>
        
    </div>
</div>





{{-- @else
<p>No restaurants</p>

@endunless --}}

@endsection