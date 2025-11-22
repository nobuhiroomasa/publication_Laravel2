@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold">予約詳細 #{{ $reservation->id }}</h1>
    <a href="{{ route('admin.reservations.index') }}" class="underline text-sm">一覧に戻る</a>
</div>
@if (session('status'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('status') }}</div>
@endif
<div class="bg-white shadow rounded p-6 space-y-2">
    <p><strong>お名前:</strong> {{ $reservation->name }}</p>
    <p><strong>メール:</strong> {{ $reservation->email }}</p>
    <p><strong>電話:</strong> {{ $reservation->phone }}</p>
    <p><strong>日付:</strong> {{ $reservation->date->format('Y-m-d') }}</p>
    <p><strong>時間:</strong> {{ $reservation->time }}</p>
    <p><strong>人数:</strong> {{ $reservation->people }}名</p>
    <p><strong>ご要望:</strong> {{ $reservation->message }}</p>
    <p><strong>ステータス:</strong> {{ $reservation->status }}</p>
</div>
<div class="mt-4 bg-white shadow rounded p-6">
    <form method="POST" action="{{ route('admin.reservations.update', $reservation) }}" class="flex items-center space-x-3">
        @csrf
        @method('PATCH')
        <label for="status" class="text-sm">ステータス更新</label>
        <select name="status" id="status" class="border rounded p-2">
            <option value="pending" @selected($reservation->status === 'pending')>未対応</option>
            <option value="confirmed" @selected($reservation->status === 'confirmed')>確定</option>
            <option value="cancelled" @selected($reservation->status === 'cancelled')>キャンセル</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded">更新</button>
    </form>
</div>
@endsection
