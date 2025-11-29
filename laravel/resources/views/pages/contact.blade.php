@extends('layouts.app')

@section('content')
<section class="paper p-8 md:p-10 space-y-4 max-w-3xl mx-auto">
    <p class="text-xs uppercase tracking-[0.3em] text-gray-500">Contact</p>
    <h1 class="text-3xl font-bold section-heading">{{ $contentValues['contact.heading'] ?? '' }}</h1>
    <p class="text-gray-700 leading-relaxed">{{ $contentValues['contact.body'] ?? '' }}</p>
</section>
@endsection
