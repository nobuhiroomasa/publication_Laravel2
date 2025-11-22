@extends('layouts.app')

@section('content')
<section class="grid md:grid-cols-5 gap-8 items-start">
    <div class="paper p-8 md:p-10 space-y-4 md:col-span-2">
        <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Access</p>
        <h1 class="text-3xl font-bold section-heading">{{ $contentValues['access.heading'] ?? '' }}</h1>
        <div class="space-y-3 text-gray-700">
            <div>
                <p class="text-sm text-gray-500">住所</p>
                <p class="font-medium">{{ $contentValues['access.address'] ?? '' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">営業時間</p>
                <p class="font-medium">{{ $contentValues['access.hours'] ?? '' }}</p>
            </div>
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span> 最寄駅から徒歩5分、静かな通り沿いにございます。
            </div>
        </div>
    </div>
    <div class="md:col-span-3 paper overflow-hidden">
        <div class="relative pt-[56%]">
            <iframe class="absolute inset-0 w-full h-full rounded-xl" src="{{ $contentValues['access.map_embed'] ?? '' }}" loading="lazy"></iframe>
        </div>
    </div>
</section>
@endsection
