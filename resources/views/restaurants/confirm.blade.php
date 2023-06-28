@extends('components.layout')

@section('main')

<div class="w-1/3 mx-auto mt-20">
    <h1 class="text-lg font-bold my-4">Confirmation Page</h1>

    <form method="POST" action="{{ route('restaurants.store') }}">
        @csrf

        <div>
            <label>Name:</label>
            {{ $inputs['name'] }}
            <input type="hidden" name="name" value="{{ $inputs['name'] }}" />
        </div>

        <div>
            <label>Furigana:</label>
            {{ $inputs['name_katakana'] }}
            <input type="hidden" name="name_katakana" value="{{ $inputs['name_katakana'] }}" />
        </div>

        <div>
            <label>Category:</label>
            <input type="checkbox" name="categories" value="{{ $inputs['categories'] }}" checked disabled />
            {{ $inputs['categories'] }}
        </div>

        <div>
            <label>Review:</label>
            {{ $inputs['review'] }}
            <input type="hidden" name="review" value="{{ $inputs['review'] }}" />
        </div>

        <div>
            <label>Picture:</label>
            {{ $inputs['food_picture'] }}
            <input type="hidden" name="food_picture" value="{{ $inputs['food_picture'] }}" />
            {{-- <input type="hidden" name="food_picture" value="https://via.placeholder.com/150x150.png/003399?text=food+et" /> --}}
        </div>

        <div>
            <label>Google Map URL:</label>
            {{ $inputs['url'] }}
            <input type="hidden" name="url" value="{{ $inputs['url'] }}" />
        </div>

        <div>
            <label>Phone Number:</label>
            {{ $inputs['phone_number'] }}
            <input type="hidden" name="phone_number" value="{{ $inputs['phone_number'] }}" />
        </div>

        <div>
            <label>Comment:</label>
            {{ $inputs['comment'] }}
            <input type="hidden" name="comment" value="{{ $inputs['comment'] }}" />
        </div>

        </div>
            <button 
                type="submit"
                name="action"
                value="edit"
                class="border-2 border-gray-300 rounded-lg px-2 py-1"
            >
                Edit
            </button>
            <button 
                type="submit"
                name="action"
                value="submit"
                class="border-2 border-gray-300 rounded-lg px-2 py-1"
            >
                Confirm
            </button>
        </div>

    </form>

</div>

@endsection