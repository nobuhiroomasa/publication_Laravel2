@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-4">ギャラリー</h1>
<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    @for($i = 1; $i <= 6; $i++)
        <div class="bg-white shadow rounded overflow-hidden">
            <img src="https://images.unsplash.com/photo-1551218808-94e220e084d2?auto=format&fit=crop&w=600&q=80" alt="店内" class="w-full h-40 object-cover">
        </div>
    @endfor
</div>
@endsection
