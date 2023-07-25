@extends('components.layout')

@section('main')

<x-card> 
    <h2 class="bg-gray-300 p-5 pl-7">新規登録</h2>

    <form method="POST" action="{{ route('users')}}" class="max-w-xs mx-auto">
        @csrf

        <div class="flex justify-between mt-8">
            <label for="name">名前</label>
            <input type="name" name="name" value="{{ old('name') }}" class="border border-gray-300 rounded p-1 pl-2" />

            @error('email')
                <p class="text-red-500 text-xs mt-1">必須項目になります</p>
            @enderror
        </div>

        <div class="flex justify-between mt-8">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" class="border border-gray-300 rounded p-1 pl-2" />

            @error('email')
                <p class="text-red-500 text-xs mt-1">必須項目になります</p>
            @enderror
        </div>

        <div class="flex justify-between mt-8">
            <label for="password">パスワード</label>
            <input type="password" name="password" value="{{ old('password') }}" class="border border-gray-300 rounded p-1 pl-2" />

            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-center mt-8 mb-10">
            <button type="submit" class="bg-blue-700 text-white rounded px-3 py-1 hover:text-blue-700 hover:bg-white border-2 border-blue-700">
                新規登録
            </button>
            <a href="/login">
                <span class="text-blue-300 ml-2">アカウントをお持ちですか？</span>
            </a>
        </div>
        
    </form>

</x-card>

@endsection