@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">{{ $contentValues['gallery.heading'] ?? '' }}</h1>
<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    @foreach ($galleryImages as $image)
        <div class="bg-white shadow rounded overflow-hidden">
            <img src="{{ $image }}" alt="店内" class="w-full h-40 object-cover">
        </div>
    @endforeach
</div>
@endsection
