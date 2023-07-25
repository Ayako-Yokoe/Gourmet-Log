@extends('components.layout')

@section('main')

<div class="w-1/3 mx-auto mt-4 text-lg font-bold">
    <h1 class="ml-8">お店　新規登録/編集</h1>

    <div>
        <form method="POST" action="{{ route('restaurants.confirm') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="restaurant_id" value="{{ $restaurant?->id ?? null }}" />

            <div class="mt-2">
                <label for="name">店名<span class="text-red-500 ml-1">*</span></label><br>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ $restaurant->name ?? old('name')}}"
                    required 
                    class="font-normal border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mt-2">
                <label for="name_katakana">店名　フリガナ<span class="text-red-500 ml-1">*</span></label><br>
                <input 
                    type="text" 
                    name="name_katakana" 
                    value="{{ $restaurant->name_katakana ?? old('name_katakana')}}"
                    required 
                    class="font-normal border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('name_katakana')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mt-2">                                                                               
                <span>カテゴリー</span><span class="text-red-500 ml-1">*</span><br>
                @foreach ($categories as $category)
                    <input type="checkbox" id="category{{ $category->id }}" name="categories[]" value="{{ $category->id }}"
                    @if (isset($selectedCategoryIds) && in_array($category->id, $selectedCategoryIds) || in_array($category->id, old('categories', []))) checked @endif
                    />
                    <label for="category{{ $category->id }}"><span class="text-md font-normal">{{ $category->name }}</span></label>
                @endforeach
            </div>

            @error('categories')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mt-2">
                <label for="review">レビュー（最高：５/ 最低：１）<span class="text-red-500 ml-1">*</span></label><br>
                <select
                    name="review"
                    required
                    class="font-normal border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                >
                    <option value=""></option>
                    <option value="5" {{ (old('review') == '5' || (isset($restaurant) && $restaurant->review == '5')) ? 'selected' : '' }}>5</option>
                    <option value="4" {{ (old('review') == '4' || (isset($restaurant) && $restaurant->review == '4')) ? 'selected' : '' }}>4</option>
                    <option value="3" {{ (old('review') == '3' || (isset($restaurant) && $restaurant->review == '3')) ? 'selected' : '' }}>3</option>
                    <option value="2" {{ (old('review') == '2' || (isset($restaurant) && $restaurant->review == '2')) ? 'selected' : '' }}>2</option>
                    <option value="1" {{ (old('review') == '1' || (isset($restaurant) && $restaurant->review == '1')) ? 'selected' : '' }}>1</option>
                </select>
            </div>

            @error('review')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mt-2">
                <label for="food_picture">料理写真</label><br>
                <input 
                    type="file" 
                    name="food_picture"
                    class="font-normal"
                />
            </div>

            @error('food_picture')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mt-2">
                <label for="map_url">Google Map URL</label><br>
                <input 
                    type="text" 
                    name="map_url" 
                    value="{{ $restaurant->map_url ?? old('map_url')}}"
                    class="font-normal border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('map_url')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mt-2">
                <label for="phone_number">電話番号</label><br>
                <input 
                    type="text" 
                    name="phone_number" 
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                    placeholder="555-555-5555"
                    value="{{ $restaurant->phone_number ?? old('phone_number')}}"
                    class="font-normal border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('phone_number')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mt-2">
                <label for="comment">コメント<span class="text-red-500 ml-1">*</span></label><br>
                <input 
                    type="text" 
                    name="comment" 
                    value="{{ $restaurant->comment ?? old('comment')}}"
                    required 
                    class="font-normal border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('comment')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <button 
                type="submit"
                class="border-2 border-gray-300 rounded-lg mt-6 ml-8 px-8 py-1"
            >
                確認画面へ
            </button>
        </form>
    </div>

</div>
    
@endsection