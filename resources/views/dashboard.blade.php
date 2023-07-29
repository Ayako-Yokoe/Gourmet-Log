@extends('components.layout')

@section('main')

<div class="w-2/3 mx-auto mt-20 text-lg">
    <p>{{ now()->format('m月d日') }}</p>
    <p>{{ $userName }}さん、こんにちは。</p>
</div>
    
@endsection