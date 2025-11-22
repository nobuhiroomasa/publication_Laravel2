<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AdminContentController extends Controller
{
    private array $defaults = [
        'home.hero_title' => '四季を味わう和のダイニング',
        'home.hero_text' => '旬の食材を活かしたお料理と、落ち着いた和の空間で心地よいひとときをお過ごしください。',
        'home.hero_image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
        'menu.heading' => '季節のおすすめ',
        'menu.items' => "旬野菜の炭火焼き盛り合わせ\n熟成牛のロースト 山椒ソース\n金目鯛の土鍋ごはん",
        'access.heading' => 'アクセス',
        'access.address' => '東京都千代田区丸の内1-1-1',
        'access.hours' => '営業時間: 11:30-22:00 (L.O 21:00)',
        'access.map_embed' => 'https://maps.google.com/maps?q=tokyo&t=&z=13&ie=UTF8&iwloc=&output=embed',
        'contact.heading' => 'お問い合わせ',
        'contact.body' => 'お問い合わせはお電話(03-xxxx-xxxx)または店頭にて承ります。',
        'gallery.heading' => 'ギャラリー',
        'gallery.images' => json_encode(array_fill(0, 6, 'https://images.unsplash.com/photo-1551218808-94e220e084d2?auto=format&fit=crop&w=600&q=80')),
    ];

    public function edit()
    {
        $contents = Content::valuesFor($this->defaults);
        $galleryImages = json_decode($contents['gallery.images'], true) ?? [];

        return view('admin.content.edit', [
            'contents' => $contents,
            'galleryImages' => $galleryImages,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'contents.home.hero_title' => ['required', 'string', 'max:255'],
            'contents.home.hero_text' => ['required', 'string'],
            'contents.menu.heading' => ['required', 'string', 'max:255'],
            'contents.menu.items' => ['required', 'string'],
            'contents.access.heading' => ['required', 'string', 'max:255'],
            'contents.access.address' => ['required', 'string', 'max:255'],
            'contents.access.hours' => ['required', 'string', 'max:255'],
            'contents.access.map_embed' => ['required', 'string'],
            'contents.contact.heading' => ['required', 'string', 'max:255'],
            'contents.contact.body' => ['required', 'string'],
            'contents.gallery.heading' => ['required', 'string', 'max:255'],
            'images.home.hero_image' => ['nullable', 'image', 'max:5120'],
            'gallery_images.*' => ['nullable', 'image', 'max:5120'],
        ], [
            'required' => ':attribute は必須です。',
            'image' => ':attribute は画像をアップロードしてください。',
            'max' => ':attribute は:max KB以内でアップロードしてください。',
        ], [
            'contents.home.hero_title' => 'トップの見出し',
            'contents.home.hero_text' => 'トップの本文',
            'contents.menu.heading' => 'メニューの見出し',
            'contents.menu.items' => 'メニュー一覧',
            'contents.access.heading' => 'アクセスの見出し',
            'contents.access.address' => '住所',
            'contents.access.hours' => '営業時間',
            'contents.access.map_embed' => '地図埋め込みURL',
            'contents.contact.heading' => 'お問い合わせ見出し',
            'contents.contact.body' => 'お問い合わせ本文',
            'contents.gallery.heading' => 'ギャラリー見出し',
            'images.home.hero_image' => 'トップ画像',
            'gallery_images.*' => 'ギャラリー画像',
        ]);

        $contents = $request->input('contents', []);

        foreach ($contents as $key => $value) {
            Content::updateValue($key, $value);
        }

        if ($request->hasFile('images.home.hero_image')) {
            $path = $request->file('images.home.hero_image')->store('uploads', 'public');
            Content::updateValue('home.hero_image', Storage::url($path));
        }

        $galleryImages = $request->input('existing_gallery_images', []);
        foreach ($request->file('gallery_images', []) as $file) {
            if ($file) {
                $path = $file->store('uploads', 'public');
                $galleryImages[] = Storage::url($path);
            }
        }

        Content::updateValue('gallery.images', json_encode(array_values($galleryImages)));

        return Redirect::route('admin.contents.edit')->with('status', 'コンテンツを更新しました。');
    }
}
