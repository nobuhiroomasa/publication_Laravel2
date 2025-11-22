@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-2 gap-8 items-center">
    <div>
        <h1 class="text-3xl mb-4 font-bold">{{ $contentValues['home.hero_title'] ?? '' }}</h1>
        <p class="leading-relaxed">{{ $contentValues['home.hero_text'] ?? '' }}</p>
        <div class="mt-6 space-x-3">
            <a href="{{ route('menu') }}" class="px-4 py-2 bg-brown-700 text-white rounded shadow">メニューを見る</a>
            <a href="{{ route('reserve') }}" class="px-4 py-2 bg-red-700 text-white rounded shadow">ご予約</a>
        </div>
    </div>
    <div class="bg-white shadow rounded p-4">
        <img src="{{ $contentValues['home.hero_image'] ?? '' }}" alt="料理" class="rounded">
    </div>
</div>
@endsection
