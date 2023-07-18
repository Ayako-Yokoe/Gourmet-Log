@extends('components.layout')

@section('main')

<div class="w-1/3 mx-auto mt-20">
    <h3>Dashboard</h3>
    <p>{{ $date }}</p>
    <p>Hello {{ $userName }}</p>
</div>
    
@endsection