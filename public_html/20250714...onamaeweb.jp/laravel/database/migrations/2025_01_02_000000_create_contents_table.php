<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        DB::table('contents')->insert([
            ['key' => 'home.hero_title', 'value' => '四季を味わう和のダイニング', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'home.hero_text', 'value' => '旬の食材を活かしたお料理と、落ち着いた和の空間で心地よいひとときをお過ごしください。', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'home.hero_image', 'value' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'menu.heading', 'value' => '季節のおすすめ', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'menu.items', 'value' => "旬野菜の炭火焼き盛り合わせ\n熟成牛のロースト 山椒ソース\n金目鯛の土鍋ごはん", 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'access.heading', 'value' => 'アクセス', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'access.address', 'value' => '東京都千代田区丸の内1-1-1', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'access.hours', 'value' => '営業時間: 11:30-22:00 (L.O 21:00)', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'access.map_embed', 'value' => 'https://maps.google.com/maps?q=tokyo&t=&z=13&ie=UTF8&iwloc=&output=embed', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact.heading', 'value' => 'お問い合わせ', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact.body', 'value' => 'お問い合わせはお電話(03-xxxx-xxxx)または店頭にて承ります。', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'gallery.heading', 'value' => 'ギャラリー', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'gallery.images', 'value' => json_encode(array_fill(0, 6, 'https://images.unsplash.com/photo-1551218808-94e220e084d2?auto=format&fit=crop&w=600&q=80')), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
