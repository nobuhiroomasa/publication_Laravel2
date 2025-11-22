@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">{{ $contentValues['menu.heading'] ?? '' }}</h1>
<ul class="space-y-3">
    @foreach (explode("\n", $contentValues['menu.items'] ?? '') as $item)
        @if (trim($item) !== '')
            <li class="bg-white shadow p-4 rounded">{{ $item }}</li>
        @endif
    @endforeach
</ul>
@endsection
