@extends('components.layout')

@section('main')
<h1>Show page / Detail</h1>

<h2>{{$restaurant->name}} restaurant Detail</h2>

<h3>{{ $restaurant->name_katakana }}</h3>

<div>
    <h3>Category: Japanese</h3>
    <h3>Review: {{ $restaurant->review }}</h3>
</div>
<h3>Picture: </h3>
<img src={{ $restaurant->food_picture }} alt="picture of the food" />
<h3>Google Map URL: </h3>
<a>{{ $restaurant->map_url }}</a>
<h3>Phone Number: {{ $restaurant->phone_number }}</h3>
<h3>Comment: </h3>
<p>{{ $restaurant->comment }}</p>

<button type="button">Back to the Restaurant List</button>
    
@endsection
