@extends('layouts.app')

@section('content')
<section class="paper p-8 md:p-10 space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Gallery</p>
            <h1 class="text-3xl font-bold section-heading">{{ $contentValues['gallery.heading'] ?? '' }}</h1>
        </div>
        <span class="text-sm text-gray-500">店内の雰囲気をご覧ください</span>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($galleryImages as $image)
            <div class="group relative overflow-hidden rounded-xl shadow-sm border border-white/70 bg-white">
                <img src="{{ $image }}" alt="店内" class="w-full h-44 md:h-52 object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
        @endforeach
    </div>
</section>
@endsection
