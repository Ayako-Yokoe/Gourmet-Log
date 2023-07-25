@extends('components.layout')

@section('main')

<div class="w-8/12 mx-auto mt-20">
    <h1 class="text-lg font-bold my-4">お店リスト</h1> 
    
    {{-- Search Restaurant --}}
    <div class="my-4">
        <form method="GET" action="{{ route('restaurants.index') }}">
            <input 
                type="search"
                name="search"
                placeholder="ここに検索ワードを入力してください" 
                class="border border-gray-300 outline-0 rounded-lg mt-2 p-1 pl-2 w-1/3" 
                value="{{ request('search') }}"
                />
            <button 
                type="submit"
                class="border border-gray-400 bg-gray-300 rounded-lg mt-2 px-2 py-1"
            >
                検索
            </button>
        </form>
    </div>

    {{-- Show Restaurant List --}}
    <div>

        <div class="flex justify-end">
            @if ($total > 0)
                <p class="my-4 mr-2">{{ $from }}-{{ $to }}/{{ $total }}件</p>
            @endif
        </div>

        <table class="table-auto w-full text-center">
            <thead>
                <tr>
                    <th class="border border-slate-300 py-4 px-2">ID</th>
                    <th class="border border-slate-300">店名</th>
                    <th class="border border-slate-300">カテゴリー</th>
                    <th class="border border-slate-300">レビュー</th>
                    <th class="border border-slate-300">コメント</th>
                    <th class="border border-slate-300">詳細</th>
                    <th class="border border-slate-300">編集</th>
                    <th class="border border-slate-300">削除</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($restaurants as $restaurant)
                    
                <tr class="px-4">
                    <td class="border border-slate-300">{{ $restaurant->id }}</td>
                    <td class="border border-slate-300">{{ $restaurant->name }}</td>
                    <td class="border border-slate-300">
                        @foreach ($restaurant->categories as $category)
                            {{ $category->name }}
                        @endforeach
                    </td>
                    <td class="border border-slate-300">{{ $restaurant->review }}</td>
                    <td class="border border-slate-300">
                        {{ Str::limit($restaurant->comment, 18, '(...)') }}
                    </td>

                    <td class="border border-slate-300">
                        <a href="/restaurants/{{ $restaurant->id }}">
                        <span class="bg-green-700 text-white rounded-xl px-3 py-1 my-2 hover:text-green-700 hover:bg-white border-2 border-green-700">
                            詳細
                        </span>
                        </a>
                    </td>

                    <td class="border border-slate-300">
                        <a href="{{ route('restaurants.edit', ['id' => $restaurant->id] )}}">
                        <span class="bg-blue-700 text-white rounded-xl px-3 py-1 hover:text-blue-700 hover:bg-white border-2 border-blue-700">
                            編集
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
                                削除
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

@endsection