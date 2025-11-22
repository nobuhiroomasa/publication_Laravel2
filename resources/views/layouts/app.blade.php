<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', '和カフェ') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        body { background: #f7f3ef; font-family: 'Noto Sans JP', sans-serif; }
        header, footer { background: #2f2b28; color: #f0e9dd; }
        a { color: #8c5042; }
    </style>
</head>
<body>
<header class="py-4">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <div class="text-2xl font-bold">和のダイニング</div>
        <nav class="space-x-4 text-sm">
            <a href="{{ route('home') }}">トップ</a>
            <a href="{{ route('menu') }}">メニュー</a>
            <a href="{{ route('gallery') }}">ギャラリー</a>
            <a href="{{ route('access') }}">アクセス</a>
            <a href="{{ route('reserve') }}" class="font-semibold">ご予約</a>
        </nav>
    </div>
</header>
<main class="container mx-auto px-4 py-8">
    @yield('content')
</main>
<footer class="py-6 mt-12">
    <div class="container mx-auto px-4 text-center text-sm">© {{ date('Y') }} 和のダイニング</div>
</footer>
</body>
</html>
