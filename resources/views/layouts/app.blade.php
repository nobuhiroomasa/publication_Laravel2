<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', '和カフェ') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Noto+Serif+JP:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        :root {
            --ink: #2a221d;
            --brown: #8c5042;
            --cream: #f7f3ef;
            --accent: #c47a53;
        }
        body {
            background: radial-gradient(circle at 20% 20%, rgba(196, 122, 83, 0.08), transparent 28%),
                        radial-gradient(circle at 80% 0%, rgba(42, 34, 29, 0.08), transparent 25%),
                        var(--cream);
            font-family: 'Noto Sans JP', sans-serif;
            color: var(--ink);
        }
        header, footer {
            background: linear-gradient(120deg, #2a221d, #382f29);
            color: #f8f4ec;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        a { color: var(--brown); }
        .nav-link { position: relative; padding-bottom: 6px; }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), #d68b61);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.2s ease;
        }
        .nav-link:hover::after,
        .nav-link:focus-visible::after,
        .nav-link.active::after { transform: scaleX(1); transform-origin: left; }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), #a85135);
            color: #fff;
            border-radius: 9999px;
            padding: 0.65rem 1.4rem;
            box-shadow: 0 12px 24px rgba(168, 81, 53, 0.2);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 16px 32px rgba(168, 81, 53, 0.28); }
        .btn-secondary {
            color: var(--ink);
            border: 1px solid rgba(42, 34, 29, 0.18);
            border-radius: 9999px;
            padding: 0.65rem 1.2rem;
            background: rgba(255, 255, 255, 0.65);
            transition: border-color 0.2s ease, background 0.2s ease;
        }
        .btn-secondary:hover { border-color: rgba(196, 122, 83, 0.4); background: rgba(255, 255, 255, 0.9); }
        .paper {
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(42, 34, 29, 0.06);
            box-shadow: 0 16px 30px rgba(0,0,0,0.08);
            backdrop-filter: blur(4px);
            border-radius: 14px;
        }
        .section-heading {
            font-family: 'Noto Serif JP', serif;
            letter-spacing: 0.02em;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
<header class="py-5">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <div class="text-2xl font-bold tracking-wide">和のダイニング</div>
        <nav class="space-x-5 text-sm flex items-center">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">トップ</a>
            <a href="{{ route('menu') }}" class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}">メニュー</a>
            <a href="{{ route('gallery') }}" class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">ギャラリー</a>
            <a href="{{ route('access') }}" class="nav-link {{ request()->routeIs('access') ? 'active' : '' }}">アクセス</a>
            <a href="{{ route('reserve') }}" class="btn-primary text-sm ml-4">ご予約</a>
        </nav>
    </div>
</header>
<main class="container mx-auto px-6 py-10 flex-1">
    @yield('content')
</main>
<footer class="py-8 mt-16">
    <div class="container mx-auto px-6 text-center text-sm tracking-wide">© {{ date('Y') }} 和のダイニング</div>
</footer>
</body>
</html>
