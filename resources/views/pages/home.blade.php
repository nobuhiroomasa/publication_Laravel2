@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-2 gap-8 items-center">
    <div>
        <h1 class="text-3xl mb-4 font-bold">四季を味わう和のダイニング</h1>
        <p class="leading-relaxed">旬の食材を活かしたお料理と、落ち着いた和の空間で心地よいひとときをお過ごしください。</p>
        <div class="mt-6 space-x-3">
            <a href="{{ route('menu') }}" class="px-4 py-2 bg-brown-700 text-white rounded shadow">メニューを見る</a>
            <a href="{{ route('reserve') }}" class="px-4 py-2 bg-red-700 text-white rounded shadow">ご予約</a>
        </div>
    </div>
    <div class="bg-white shadow rounded p-4">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80" alt="料理" class="rounded">
    </div>
</div>
@endsection
