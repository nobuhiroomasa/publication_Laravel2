@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">{{ $contentValues['access.heading'] ?? '' }}</h1>
<p class="mb-2">{{ $contentValues['access.address'] ?? '' }}</p>
<p class="mb-2">{{ $contentValues['access.hours'] ?? '' }}</p>
<div class="mt-4">
    <iframe class="w-full h-64" src="{{ $contentValues['access.map_embed'] ?? '' }}"></iframe>
</div>
@endsection
