@extends('components.layout')

@section('main')

<div class="w-3/5 mx-auto mt-20">

    <h1 class="text-lg font-bold my-4">カテゴリー管理</h1>

    {{-- Create New Category --}}
    <div class="my-4">

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <label for="name">新規カテゴリー</label><br>
            <input 
                type="text" 
                name="name" 
                class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-1/4"
            />
            
            <button 
                type="submit"
                class="border border-gray-400 bg-gray-300 rounded-lg mt-2 px-2 py-1"
            >
                登録
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
                    <th class="border border-slate-300">カテゴリー</th>
                    <th class="border border-slate-300">編集</th>
                    <th class="border border-slate-300">削除</th>
                </tr>
            </thead>


            <tbody>
               @foreach ($categories as $category)
                   <tr class="px-4">
                        <td class="border border-slate-300">{{ $category->id }}</td>


                        @if (!$isEditing)
                            <td class="border border-slate-300">{{ $category->name }}</td>
                        @else
                            <td class="border border-slate-300">
                                <form method="POST" action="/categories/{{ $category->id }}" >
                                    @csrf
                                    @method('PUT')

                                    <input 
                                        type="text" 
                                        name="name"
                                        value="{{ $category->name }}"
                                        class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                                    />
                                    <button 
                                        type="submit"
                                        class="border border-gray-400 bg-gray-300 rounded-lg mt-2 px-2 py-1"
                                    >
                                        登録
                                    </button>
                                </form>
                            </td>

                        @endif

                    {{-- @if ($isEditing && $editingCategoryId === $category->id )
                        <td>
                            <form method="POST" action="/categories/{{ $category->id }}" >
                                @csrf
                                @method('PUT')

                                <input 
                                    type="text" 
                                    name="name"
                                    value="{{ $category->name }}"
                                    class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-1/4"
                                />
                                <button 
                                    type="submit"
                                    class="border border-gray-400 bg-gray-300 rounded-lg mt-2 px-2 py-1"
                                >
                                    Save
                                </button>
                            </form>
                        </td>
                    
                    @else
                        <td class="border border-slate-300">{{ $category->name }}</td>
                    @endif --}}

                {{-- !!! --}}

                        <td class="border border-slate-300">
                            {{-- <form method="POST" action="/categories/{{ $category->id }}/edit">
                                @csrf

                                <input type="hidden" name="editingCategoryId" value="{{ $category->id }}" />
                                <button
                                    type="submit"
                                    class="bg-red-700 text-white rounded-xl px-3 py-1 hover:text-red-700 hover:bg-white border-2 border-red-700"
                                >
                                    Edit
                                </button>
                            </form> --}}

                            <form method="POST" action="/categories/{{ $category->id }}/edit">
                                @csrf
                                <button type="submit" class="bg-violet-700 text-white rounded-xl px-3 py-1 hover:text-violet-700 hover:bg-white border-2 border-violet-700">
                                    編集
                                </button>
                            </form>
                            
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
                                    削除
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