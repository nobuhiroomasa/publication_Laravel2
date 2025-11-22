@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold">コンテンツ管理</h1>
    <div class="flex space-x-4 text-sm">
        <a href="{{ route('admin.reservations.index') }}" class="underline">予約一覧</a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="underline">ログアウト</button>
        </form>
    </div>
</div>

@if (session('status'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('status') }}</div>
@endif

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc ml-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.contents.update') }}" enctype="multipart/form-data" class="space-y-8">
    @csrf

    <section class="bg-white shadow rounded p-6 space-y-4">
        <h2 class="text-xl font-semibold mb-2">トップ</h2>
        <div>
            <label class="block text-sm mb-1">見出し</label>
            <input type="text" name="contents[home.hero_title]" value="{{ old('contents.home.hero_title', $contents['home.hero_title']) }}" class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm mb-1">本文</label>
            <textarea name="contents[home.hero_text]" rows="3" class="w-full border rounded p-2">{{ old('contents.home.hero_text', $contents['home.hero_text']) }}</textarea>
        </div>
        <div>
            <label class="block text-sm mb-1">背景画像</label>
            <div class="flex items-center space-x-4 mb-2">
                <img src="{{ $contents['home.hero_image'] }}" alt="現在の画像" class="w-32 h-20 object-cover rounded">
                <span class="text-sm text-gray-600">変更する場合はファイルを選択してください</span>
            </div>
            <input type="file" name="images[home.hero_image]" accept="image/*">
        </div>
    </section>

    <section class="bg-white shadow rounded p-6 space-y-4">
        <h2 class="text-xl font-semibold mb-2">メニュー</h2>
        <div>
            <label class="block text-sm mb-1">見出し</label>
            <input type="text" name="contents[menu.heading]" value="{{ old('contents.menu.heading', $contents['menu.heading']) }}" class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm mb-1">メニュー一覧（1行につき1品）</label>
            <textarea name="contents[menu.items]" rows="4" class="w-full border rounded p-2">{{ old('contents.menu.items', $contents['menu.items']) }}</textarea>
        </div>
    </section>

    <section class="bg-white shadow rounded p-6 space-y-4">
        <h2 class="text-xl font-semibold mb-2">アクセス</h2>
        <div>
            <label class="block text-sm mb-1">見出し</label>
            <input type="text" name="contents[access.heading]" value="{{ old('contents.access.heading', $contents['access.heading']) }}" class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm mb-1">住所</label>
            <input type="text" name="contents[access.address]" value="{{ old('contents.access.address', $contents['access.address']) }}" class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm mb-1">営業時間</label>
            <input type="text" name="contents[access.hours]" value="{{ old('contents.access.hours', $contents['access.hours']) }}" class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm mb-1">地図埋め込みURL</label>
            <input type="text" name="contents[access.map_embed]" value="{{ old('contents.access.map_embed', $contents['access.map_embed']) }}" class="w-full border rounded p-2">
            <p class="text-xs text-gray-500 mt-1">Googleマップの共有 > 地図を埋め込む で取得できるURLを貼り付けてください。</p>
        </div>
    </section>

    <section class="bg-white shadow rounded p-6 space-y-4">
        <h2 class="text-xl font-semibold mb-2">お問い合わせ</h2>
        <div>
            <label class="block text-sm mb-1">見出し</label>
            <input type="text" name="contents[contact.heading]" value="{{ old('contents.contact.heading', $contents['contact.heading']) }}" class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block text-sm mb-1">本文</label>
            <textarea name="contents[contact.body]" rows="3" class="w-full border rounded p-2">{{ old('contents.contact.body', $contents['contact.body']) }}</textarea>
        </div>
    </section>

    <section class="bg-white shadow rounded p-6 space-y-4">
        <h2 class="text-xl font-semibold mb-2">ギャラリー</h2>
        <div>
            <label class="block text-sm mb-1">見出し</label>
            <input type="text" name="contents[gallery.heading]" value="{{ old('contents.gallery.heading', $contents['gallery.heading']) }}" class="w-full border rounded p-2">
        </div>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($galleryImages as $index => $image)
                <div class="border rounded p-3 space-y-2">
                    <img src="{{ $image }}" alt="ギャラリー画像" class="w-full h-32 object-cover rounded">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="existing_gallery_images[]" value="{{ $image }}" checked class="form-checkbox">
                        <span class="text-sm">この画像を残す</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            <label class="block text-sm mb-1">画像を追加</label>
            <input type="file" name="gallery_images[]" accept="image/*" multiple>
            <p class="text-xs text-gray-500 mt-1">複数選択できます。既存のチェックを外すと削除されます。</p>
        </div>
    </section>

    <div class="flex justify-end pt-6 border-t">
        <button type="submit" class="px-5 py-2 bg-brown-700 text-white rounded">更新する</button>
    </div>
</form>
@endsection
