@extends('layouts.app')

@section('content')
<section class="paper p-8 md:p-10 mb-10 grid md:grid-cols-2 gap-10 items-center">
    <div class="space-y-4">
        <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Seasonal Dining</p>
        <h1 class="text-3xl md:text-4xl font-bold section-heading leading-tight">{{ $contentValues['home.hero_title'] ?? '' }}</h1>
        <p class="leading-relaxed text-gray-700">{{ $contentValues['home.hero_text'] ?? '' }}</p>
        <div class="flex flex-wrap gap-3 pt-2">
            <a href="{{ route('menu') }}" class="btn-primary">メニューを見る</a>
            <a href="{{ route('reserve') }}" class="btn-secondary">ご予約はこちら</a>
        </div>
        <div class="grid grid-cols-2 gap-4 pt-4 text-sm">
            <div class="rounded-lg bg-gradient-to-br from-white to-amber-50 border border-amber-100 p-4 shadow-inner">
                <p class="text-gray-500 mb-1">本日のおすすめ</p>
                <p class="font-semibold text-lg text-amber-900">旬の和食コース</p>
            </div>
            <div class="rounded-lg bg-gradient-to-br from-white to-rose-50 border border-rose-100 p-4 shadow-inner">
                <p class="text-gray-500 mb-1">営業時間</p>
                <p class="font-semibold text-lg text-rose-900">17:00 - 23:00</p>
            </div>
        </div>
    </div>
    <div class="relative">
        <div class="absolute -inset-4 bg-gradient-to-br from-amber-200/40 via-white to-rose-100/50 rounded-2xl blur"></div>
        <div class="relative overflow-hidden rounded-2xl shadow-2xl border border-white/70">
            <img src="{{ $contentValues['home.hero_image'] ?? '' }}" alt="料理" class="w-full h-full object-cover">
        </div>
    </div>
</section>

<section class="grid md:grid-cols-3 gap-6">
    <div class="paper p-6 space-y-3">
        <div class="text-sm text-gray-500">こだわりの食材</div>
        <h2 class="font-semibold text-xl section-heading">旬の恵みを一皿に</h2>
        <p class="text-gray-700 leading-relaxed">季節の食材を厳選し、だしの旨味を大切にした料理でおもてなしいたします。</p>
    </div>
    <div class="paper p-6 space-y-3">
        <div class="text-sm text-gray-500">空間</div>
        <h2 class="font-semibold text-xl section-heading">静かで落ち着く和の空気</h2>
        <p class="text-gray-700 leading-relaxed">柔らかな照明と木の質感が調和する店内で、ゆったりとした時間をお過ごしください。</p>
    </div>
    <div class="paper p-6 space-y-3">
        <div class="text-sm text-gray-500">サービス</div>
        <h2 class="font-semibold text-xl section-heading">丁寧なもてなし</h2>
        <p class="text-gray-700 leading-relaxed">記念日や会食など用途に合わせたプランをご用意し、きめ細やかに対応いたします。</p>
    </div>
</section>
@endsection
