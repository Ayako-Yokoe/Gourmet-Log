@extends('components.layout')

@section('main')

<div class="w-1/3 mx-auto mt-4 text-lg font-bold">

    <h2 class="my-2">{{$restaurant->name}} 詳細</h2>

    <h3 class="my-2">{{ $restaurant->name_katakana }}</h3>

    <div class="flex flex-start my-2">
        <div>
            <h3>カテゴリー:</h3>
            @foreach ($categories as $category)
                {{ $category->name }}
            @endforeach
        </div>
        <div class="ml-20">
            <h3>レビュー:</h3> 
            <p>{{ $restaurant->review }}</p>
        </div>
    </div>

    <div class="my-2">
        <h3>料理写真: </h3>
        <img 
            src={{ $restaurant->food_picture }} 
            alt="picture of the food"
            class="w-60 h-44 object-cover"
        />
    </div>

    <div class="my-2">
        <h3>Google Map URL: </h3>
        {{-- <a>{{ $restaurant->map_url }}</a> --}}
        <iframe
            width="240"
            height="160"
            frameborder="0"
            style="border:0"
            src="{{ $restaurant->map_url }}"
            alt="google map"
        ></iframe>
    </div>

    <div class="my-2">
        <h3>電話番号:</h3>
        <p>{{ $restaurant->phone_number }}</p>
    </div>

    <div class="my-2">
        <h3>コメント: </h3>
        <p>{{ $restaurant->comment }}</p>
    </div>

    <div class="flex flex-start mt-4">
        <button 
            type="button"
            class="border-2 border-gray-300 rounded-lg px-6 py-1 ml-10"
        >
            <a href="/restaurants"> 
                お店リストに戻る
            </a>
        </button>
    </div>

</div>
    
@endsection
