@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">ご予約</h1>
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc ml-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('reserve.store') }}" class="bg-white shadow rounded p-6 space-y-4">
    @csrf
    <div>
        <label class="block text-sm mb-1">お名前</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block text-sm mb-1">メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block text-sm mb-1">電話番号</label>
        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded p-2" required>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm mb-1">日付</label>
            <input type="date" name="date" value="{{ old('date') }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-sm mb-1">時間</label>
            <input type="time" name="time" value="{{ old('time') }}" class="w-full border rounded p-2" required>
        </div>
    </div>
    <div>
        <label class="block text-sm mb-1">人数</label>
        <input type="number" name="people" min="1" value="{{ old('people', 2) }}" class="w-full border rounded p-2" required>
    </div>
    <div>
        <label class="block text-sm mb-1">ご要望</label>
        <textarea name="message" class="w-full border rounded p-2" rows="4">{{ old('message') }}</textarea>
    </div>
    <div class="text-right">
        <button type="submit" class="px-4 py-2 bg-red-700 text-white rounded">送信する</button>
    </div>
</form>
@endsection
