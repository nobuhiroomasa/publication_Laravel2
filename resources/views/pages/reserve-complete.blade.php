@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-8 text-center">
    <h1 class="text-2xl font-semibold mb-4">送信できました</h1>
    <p class="mb-6">ご予約ありがとうございます。担当者よりご連絡いたします。</p>
    <a href="{{ route('home') }}" class="text-brown-700 underline">トップへ戻る</a>
</div>
@endsection
