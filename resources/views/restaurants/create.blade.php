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

            {{-- Checked for the old value didn't work --}}
            <div>                                                                               
                <span>Category</span><br>

                {{-- When coming from Edit button, we don't have $categories --}}

                @foreach ($categories as $category)
                    <input type="checkbox" id="category{{ $category->id }}" name="categories[]" value="{{ $category->id }}" />
                    <label for="category{{ $category->id }}">{{ $category->name }}</label>
                @endforeach
    
                {{-- <input type="checkbox" id="category1" name="categories[]" value="Japanese" @if (in_array('Japanese', (array) ($restaurant->categories ?? old('categories', [])))) checked @endif />
                <label for="category1">Japanese</label>
                <input type="checkbox" id="category2" name="categories[]" value="Chinese" @if (in_array('Chinese', (array) ($restaurant->categories ?? old('categories', [])))) checked @endif />
                <label for="category2">Chinese</label>
                <input type="checkbox" id="category3" name="categories[]" value="French" @if (in_array('French', (array) ($restaurant->categories ?? old('categories', [])))) checked @endif />
                <label for="category3">French</label> --}}
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
                    <option value="" selected>{{ $restaurant->review ?? "" }}</option>
                    <option value="5" @if(old('review') == '5') selected @endif>5</option>
                    <option value="4" @if(old('review') == '4') selected @endif>4</option>
                    <option value="3" @if(old('review') == '3') selected @endif>3</option>
                    <option value="2" @if(old('review') == '2') selected @endif>2</option>
                    <option value="1" @if(old('review') == '1') selected @endif>1</option>
                </select>
            </div>

            @error('review')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div>
                <label>Photo of Food</label><br>
                <input 
                    type="file" 
                    name="food_picture"
                    value="{{ $restaurant->food_picture ?? old('food_picture')}}"
                    {{-- value="https://via.placeholder.com/150x150.png/003399?text=food+et" --}}
                    />
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
