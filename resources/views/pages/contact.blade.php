@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">{{ $contentValues['contact.heading'] ?? '' }}</h1>
<p>{{ $contentValues['contact.body'] ?? '' }}</p>
@endsection
