@extends('components.layout')

@section('main')

<div class="w-3/5 mx-auto mt-20">

    <h1 class="text-lg font-bold my-4">Manage Categories</h1>

    {{-- Create New Category --}}
    <div class="my-4">

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <label for="name">New Category</label><br>
            <input 
                type="text" 
                name="name" 
                class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-1/4"
            />
            
            <button 
                type="submit"
                class="border border-gray-400 bg-gray-300 rounded-lg mt-2 px-2 py-1"
            >
                Register
            </button>

        </form>

        @error('name')
            {{ $message }}
        @enderror
    </div>


    {{-- List Table --}}
    <div>

        <table class="table-auto w-full text-center">
            <thead>
                <tr>
                    <th class="border border-slate-300 py-4 px-2">ID</th>
                    <th class="border border-slate-300">Category</th>
                    <th class="border border-slate-300">Edit</th>
                    <th class="border border-slate-300">Delete</th>
                </tr>
            </thead>

            <tbody>
               @foreach ($categories as $category)
                   <tr class="px-4">
                        <td class="border border-slate-300">{{ $category->id }}</td>

                {{-- !!! --}}
                    {{-- @if () --}}
                        <td class="border border-slate-300">{{ $category->name }}</td>
                    {{-- @endif ()
                        <td>
                            <form method="POST" action="" >
                                @csrf
                                <input type="text" name="category" />
                            </form>
                        </td>

                    @endif --}}
                {{-- !!! --}}


 
                        <td class="border border-slate-300">
                            <button type="submit">Edit</button>
                            {{-- <a href="/categories/{id}/edit">Edit</a> --}}
                        </td>


                        <td class="border border-slate-300">
                            <form method="POST" action="/categories/{{ $category->id }}">
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
            {{ $categories->render('components.pagination')}}
        </div>
    </div>

</div>


    
@endsection