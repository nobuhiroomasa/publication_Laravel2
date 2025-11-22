@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white shadow rounded p-6">
    <h1 class="text-xl font-semibold mb-4">管理ログイン</h1>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm mb-1">パスワード</label>
            <input type="password" name="password" class="w-full border rounded p-2" required autofocus>
        </div>
        <button type="submit" class="w-full py-2 bg-gray-800 text-white rounded">ログイン</button>
    </form>
</div>
@endsection
