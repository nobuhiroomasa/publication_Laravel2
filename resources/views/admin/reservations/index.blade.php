@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold">予約一覧</h1>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="text-sm underline">ログアウト</button>
    </form>
</div>
<div class="bg-white shadow rounded">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3">ID</th>
                <th class="p-3">お名前</th>
                <th class="p-3">日付</th>
                <th class="p-3">時間</th>
                <th class="p-3">人数</th>
                <th class="p-3">ステータス</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr class="border-t">
                    <td class="p-3">{{ $reservation->id }}</td>
                    <td class="p-3">{{ $reservation->name }}</td>
                    <td class="p-3">{{ $reservation->date->format('Y-m-d') }}</td>
                    <td class="p-3">{{ $reservation->time }}</td>
                    <td class="p-3">{{ $reservation->people }}</td>
                    <td class="p-3">{{ $reservation->status }}</td>
                    <td class="p-3 text-right"><a class="underline" href="{{ route('admin.reservations.show', $reservation) }}">詳細</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $reservations->links() }}</div>
@endsection
