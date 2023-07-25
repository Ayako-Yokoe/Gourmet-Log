@extends('components.layout')

@section('main')

<div class="w-1/3 mx-auto mt-4 text-md font-bold">
    <h1 class="my-4">新規登録　確認画面</h1>

    <form method="POST" action="{{ route('restaurants.store') }}">
        @csrf

        <input type="hidden" name="id" value="{{ $inputs['id'] }}" />

        <div class="mt-2">
            <label>店名:</label>
            {{ $inputs['name'] }}
            <input type="hidden" name="name" value="{{ $inputs['name'] }}" />
        </div>

        <div class="mt-2">
            <label>フリガナ:</label>
            {{ $inputs['name_katakana'] }}
            <input type="hidden" name="name_katakana" value="{{ $inputs['name_katakana'] }}" />
        </div>

        <div class="mt-2">
            <label>カテゴリー:</label>

            @foreach ($inputs['categories'] as $category)
                <input type="hidden" name="categories[]" value="{{ $category }}" />
            @endforeach

            @foreach ($categoryValues as $categoryValue)
                {{ $categoryValue }}
            @endforeach
        </div>

        <div class="mt-2">
            <label>レビュー:</label>
            {{ $inputs['review'] }}
            <input type="hidden" name="review" value="{{ $inputs['review'] }}" />
        </div>

        <div class="mt-2">
            <label>料理写真:</label>
            @if (!$inputs['food_picture'])
                <p class="text-red-500 text-xs mt-1">選択された写真はありません。</p>
            @else
                <img 
                    src="{{ $inputs['food_picture'] }}" 
                    alt="food photo" 
                    class="w-64 h-48 object-cover"
                />
            @endif

            <input type="hidden" name="food_picture" value="{{ $inputs['food_picture'] }}" />
        </div>

        <div class="mt-2">
            <label>Google Map URL:</label>
            <iframe
                width="240"
                height="160"
                frameborder="0"
                style="border:0"
                src="{{ $inputs['map_url'] }}"
                alt="google map"
            ></iframe>

            <input type="hidden" name="map_url" value="{{ $inputs['map_url'] }}" />
        </div>

        <div class="mt-2">
            <label>電話番号:</label>
            {{ $inputs['phone_number'] }}
            <input type="hidden" name="phone_number" value="{{ $inputs['phone_number'] }}" />
        </div>

        <div class="mt-2">
            <label>コメント:</label>
            {{ $inputs['comment'] }}
            <input type="hidden" name="comment" value="{{ $inputs['comment'] }}" />
        </div>

        <input type="hidden" name="restaurant_id" value="{{ $inputs['id'] }}" />

        <div class="mt-4">
            <button 
                type="submit"
                name="action"
                value="edit"
                class="border-2 border-gray-300 rounded-lg px-4 py-1"
            >
                修正する
            </button>
            <button 
                type="submit"
                name="action"
                value="submit"
                class="bg-violet-700 text-white rounded-xl my-1 px-4 py-1 hover:text-violet-700 hover:bg-white border-2 border-violet-700 ml-14"
            >
                登録する
            </button>
        </div>

    </form>

</div>

@endsection