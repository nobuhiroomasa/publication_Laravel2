@extends('layouts.app')

@section('content')
<div class="paper p-10 text-center space-y-4 max-w-3xl mx-auto">
    <div class="mx-auto w-14 h-14 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
        ✓
    </div>
    <h1 class="text-3xl font-bold section-heading">送信できました</h1>
    <p class="text-gray-700">ご予約ありがとうございます。担当者よりご連絡いたします。</p>
    <a href="{{ route('home') }}" class="btn-secondary inline-block">トップへ戻る</a>
</div>
@endsection
