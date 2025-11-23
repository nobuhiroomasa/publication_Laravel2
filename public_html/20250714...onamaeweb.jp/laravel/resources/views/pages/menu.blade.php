@extends('layouts.app')

@section('content')
<section class="paper p-8 md:p-10 space-y-6">
    <div class="flex items-baseline justify-between flex-wrap gap-3">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Menu</p>
            <h1 class="text-3xl font-bold section-heading">{{ $contentValues['menu.heading'] ?? '' }}</h1>
        </div>
        <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-sm">おすすめを厳選</span>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        @foreach (explode("\n", $contentValues['menu.items'] ?? '') as $item)
            @if (trim($item) !== '')
                <div class="relative overflow-hidden rounded-xl border border-amber-100 bg-white shadow-sm p-5">
                    <div class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-amber-300 to-amber-500"></div>
                    <p class="font-semibold text-lg text-amber-900">{{ $item }}</p>
                    <p class="text-sm text-gray-600 mt-1">香り立つだしと季節の素材で仕上げています。</p>
                </div>
            @endif
        @endforeach
    </div>
    <div class="text-sm text-gray-500 flex items-center gap-2">
        <span class="w-2 h-2 rounded-full bg-amber-400"></span> 表示価格・内容は季節によって変更となる場合がございます。
    </div>
</section>
@endsection
