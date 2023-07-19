@extends('components.layout')

@section('main')

<div class="w-1/3 mx-auto mt-20">
    <p>{{ now()->format('m月d日') }}</p>
    <p>{{ $userName }}さん</p>
</div>
    
@endsection