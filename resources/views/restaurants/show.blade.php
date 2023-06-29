@extends('components.layout')

@section('main')

<div class="w-1/3 mx-auto mt-20">
    <h1 class="text-lg font-bold my-4">Show page / Detail</h1>

    <h2 class="my-4">{{$restaurant->name}} restaurant Detail</h2>

    <h3 class="my-4">{{ $restaurant->name_katakana }}</h3>

    <div class="flex justify-between my-4">
        <div>
            <h3>Category:</h3>
            <p>Japanese</p>
        </div>
        <div>
            <h3>Review:</h3> 
            <p>{{ $restaurant->review }}</p>
        </div>
    </div>

    <div class="my-4">
        <h3>Picture: </h3>
        <img src={{ $restaurant->food_picture }} alt="picture of the food" />
    </div>

    <div class="my-4">
        <h3>Google Map URL: </h3>
        <a>{{ $restaurant->map_url }}</a>
    </div>

    <div class="my-4">
        <h3>Phone Number:</h3>
        <p>{{ $restaurant->phone_number }}</p>
    </div>

    <div class="my-4">
        <h3>Comment: </h3>
        <p>{{ $restaurant->comment }}</p>
    </div>

    <div class="flex justify-center mt-6">
        <button 
            type="button"
            class="border-2 border-gray-300 rounded-lg px-2 py-1"
        >
            <a href="/restaurants"> 
                Back to the Restaurant List
            </a>
        </button>
    </div>

</div>
    
@endsection
