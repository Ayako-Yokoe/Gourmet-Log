@extends('components.layout')

@section('main')


<div class="w-1/3 mx-auto mt-20">
    <h1>Create/Edit Restaurant</h1>

    <div>

        {{-- <form method="POST" action="{{ $restaurant->id ? route('restaurants.store') : route('restaurants.confirm') }}"> --}}

        <form method="POST" action="{{ route('restaurants.confirm') }}" enctype="multipart/form-data">
            @csrf

            {{-- <p>id: {{ $restaurant->id }}</p> --}}
            <input type="hidden" name="restaurant_id" value="{{ $restaurant?->id ?? null }}" />

            <div>
                <label for="name">Name of Restaurant</label><br>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ $restaurant->name ?? old('name')}}"
                    required 
                    class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div>
                <label for="name_katakana">Name of Restaurant Furigana</label><br>
                <input 
                    type="text" 
                    name="name_katakana" 
                    value="{{ $restaurant->name_katakana ?? old('name_katakana')}}"
                    required 
                    class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('name_katakana')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div>                                                                               
                <span>Category</span><br>

                @foreach ($categories as $category)
                    <input type="checkbox" id="category{{ $category->id }}" name="categories[]" value="{{ $category->id }}"
                    @if (isset($selectedCategoryIds) && in_array($category->id, $selectedCategoryIds) || in_array($category->id, old('categories', []))) checked @endif
                    />
                    <label for="category{{ $category->id }}">{{ $category->name }}</label>
                @endforeach
    
            </div>

            @error('categories')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div>
                <label for="review">Review (Max: 5/ Min: 1)</label><br>
                <select
                    name="review"
                    required
                    class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
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

            <div>
                <label for="food_picture">Photo of Food</label><br>
                <input 
                    type="file" 
                    name="food_picture"
                    {{-- value="{{ $restaurant->food_picture ?? old('food_picture')}}" --}}
                    {{-- value="https://via.placeholder.com/150x150.png/003399?text=food+et" --}}
                    />
                @if (isset($restaurant) && !$errors->has('food_picture') && $restaurant->food_picture)
                    {{ $restaurant->food_picture}}
                @endif
            </div>

            @error('food_picture')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div>
                <label for="map_url">Google Map URL</label><br>
                <input 
                    type="text" 
                    name="map_url" 
                    value="{{ $restaurant->map_url ?? old('map_url')}}"
                    class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('map_url')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div>
                <label for="phone_number">Phone Number</label><br>
                <input 
                    type="text" 
                    name="phone_number" 
                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                    value="{{ $restaurant->phone_number ?? old('phone_number')}}"
                    class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('phone_number')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div>
                <label for="comment">Comment</label><br>
                <input 
                    type="text" 
                    name="comment" 
                    value="{{ $restaurant->comment ?? old('comment')}}"
                    required 
                    class="border border-gray-300 rounded-lg mt-2 p-1 pl-2 w-3/4"
                />
            </div>

            @error('comment')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <button 
                type="submit"
                class="border-2 border-gray-300 rounded-lg mt-6 px-2 py-1"
            >
                To Confirmation Page
            </button>
        </form>
    </div>

</div>
    
@endsection
