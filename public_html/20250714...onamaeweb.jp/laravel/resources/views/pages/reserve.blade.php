@extends('layouts.app')

@section('content')
<section class="paper p-8 md:p-10 space-y-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Reservation</p>
            <h1 class="text-3xl font-bold section-heading">ご予約</h1>
            <p class="text-sm text-gray-500 mt-1">特別な時間をスムーズにご案内します。</p>
        </div>
        <div class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm">空席状況はお気軽にお問い合わせください</div>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 text-red-700 p-4 rounded-lg border border-red-100">
            <p class="font-semibold mb-2">入力内容をご確認ください。</p>
            <ul class="list-disc ml-5 space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reserve.store') }}" class="space-y-5">
        @csrf
        <div class="grid md:grid-cols-2 gap-5">
            <div class="space-y-2">
                <label class="block text-sm text-gray-600">お名前</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-200 rounded-lg p-3 focus:ring-2 focus:ring-amber-400 focus:border-amber-400" required>
            </div>
            <div class="space-y-2">
                <label class="block text-sm text-gray-600">メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-200 rounded-lg p-3 focus:ring-2 focus:ring-amber-400 focus:border-amber-400" required>
            </div>
            <div class="space-y-2">
                <label class="block text-sm text-gray-600">電話番号</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-200 rounded-lg p-3 focus:ring-2 focus:ring-amber-400 focus:border-amber-400" required>
            </div>
            <div class="grid grid-cols-2 gap-4 col-span-1 md:col-span-2">
                <div class="space-y-2">
                    <label class="block text-sm text-gray-600">日付</label>
                    <input type="date" name="date" value="{{ old('date') }}" class="w-full border border-gray-200 rounded-lg p-3 focus:ring-2 focus:ring-amber-400 focus:border-amber-400" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm text-gray-600">時間</label>
                    <input type="time" name="time" value="{{ old('time') }}" class="w-full border border-gray-200 rounded-lg p-3 focus:ring-2 focus:ring-amber-400 focus:border-amber-400" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="block text-sm text-gray-600">人数</label>
                <input type="number" name="people" min="1" value="{{ old('people', 2) }}" class="w-full border border-gray-200 rounded-lg p-3 focus:ring-2 focus:ring-amber-400 focus:border-amber-400" required>
            </div>
        </div>
        <div class="space-y-2">
            <label class="block text-sm text-gray-600">ご要望</label>
            <textarea name="message" class="w-full border border-gray-200 rounded-lg p-3 focus:ring-2 focus:ring-amber-400 focus:border-amber-400" rows="4">{{ old('message') }}</textarea>
            <p class="text-xs text-gray-500">アレルギーや記念日のプレートなどございましたらお知らせください。</p>
        </div>
        <div class="text-right">
            <button type="submit" class="btn-primary">送信する</button>
        </div>
    </form>
</section>
@endsection
