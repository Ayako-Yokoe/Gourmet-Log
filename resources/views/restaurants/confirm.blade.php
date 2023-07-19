@extends('components.layout')

@section('main')

<div class="w-1/3 mx-auto mt-10">
    <h1 class="text-lg font-bold my-4">新規登録　確認画面</h1>

    <form method="POST" action="{{ route('restaurants.store') }}">
        @csrf

        {{-- <p>id: {{ $inputs['id'] }}</p> --}}
        <input type="hidden" name="id" value="{{ $inputs['id'] }}" />

        <div>
            <label>店名:</label>
            {{ $inputs['name'] }}
            <input type="hidden" name="name" value="{{ $inputs['name'] }}" />
        </div>

        <div>
            <label>フリガナ:</label>
            {{ $inputs['name_katakana'] }}
            <input type="hidden" name="name_katakana" value="{{ $inputs['name_katakana'] }}" />
        </div>

        <div>
            <label>カテゴリー:</label>

            @foreach ($inputs['categories'] as $category)
                <input type="hidden" name="categories[]" value="{{ $category }}" />
            @endforeach

            @foreach ($categoryValues as $categoryValue)
                {{ $categoryValue }}
            @endforeach
        </div>

        <div>
            <label>レビュー:</label>
            {{ $inputs['review'] }}
            <input type="hidden" name="review" value="{{ $inputs['review'] }}" />
        </div>

        <div>
            <label>料理写真:</label>
            <img 
                src="{{ $inputs['food_picture'] }}" 
                alt="food photo" 
                class="w-64 h-48 object-cover"
            />

            <input type="hidden" name="food_picture" value="{{ $inputs['food_picture'] }}" />
            {{-- <input type="hidden" name="food_picture" value="https://via.placeholder.com/150x150.png/003399?text=food+et" /> --}}
        </div>

        <div>
            <label>Google Map URL:</label>
            <iframe
                width="280"
                height="208"
                frameborder="0"
                style="border:0"
                src="{{ $inputs['map_url'] }}"
                alt="google map"
            ></iframe>

            <input type="hidden" name="map_url" value="{{ $inputs['map_url'] }}" />
        </div>

        <div>
            <label>電話番号:</label>
            {{ $inputs['phone_number'] }}
            <input type="hidden" name="phone_number" value="{{ $inputs['phone_number'] }}" />
        </div>

        <div>
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
                class="border-2 border-gray-300 rounded-lg px-2 py-1"
            >
                修正する
            </button>
            <button 
                type="submit"
                name="action"
                value="submit"
                class="border-2 border-gray-300 rounded-lg px-2 py-1"
            >
                登録する
            </button>
        </div>

    </form>

</div>

@endsection