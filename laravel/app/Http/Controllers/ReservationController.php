<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function showPublicPage()
    {
        $routeName = request()->route()?->getName();

        $pages = [
            'home' => 'home',
            'menu' => 'menu',
            'access' => 'access',
            'contact' => 'contact',
            'reserve' => 'reserve',
            'gallery' => 'gallery',
        ];

        $view = $pages[$routeName] ?? 'home';

        $contents = $this->contentFor($view);

        return view('pages.' . $view, $contents);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute は必須項目です。',
            'email' => 'メールアドレスの形式が正しくありません。',
            'date' => '日付を正しく入力してください。',
            'integer' => '数値で入力してください。',
            'min' => ':attribute は:min文字以上で入力してください。',
        ];

        $attributes = [
            'name' => 'お名前',
            'email' => 'メールアドレス',
            'phone' => '電話番号',
            'date' => '日付',
            'time' => '時間',
            'people' => '人数',
            'message' => 'ご要望',
        ];

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:30'],
            'date' => ['required', 'date'],
            'time' => ['required', 'string', 'max:10'],
            'people' => ['required', 'integer', 'min:1'],
            'message' => ['nullable', 'string', 'max:1000'],
        ], $messages, $attributes);

        $validator->validate();

        Reservation::create([
            'name' => $request->string('name'),
            'email' => $request->string('email'),
            'phone' => $request->string('phone'),
            'date' => $request->date('date'),
            'time' => $request->string('time'),
            'people' => $request->integer('people'),
            'message' => $request->input('message'),
            'status' => 'pending',
        ]);

        return redirect()->route('reserve.complete');
    }

    public function complete()
    {
        return view('pages.reserve-complete');
    }

    public function adminIndex()
    {
        $reservations = Reservation::orderByDesc('created_at')->paginate(10);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function adminShow(Reservation $reservation)
    {
        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ], [
            'required' => ':attribute は必須です。',
            'in' => 'ステータスが不正です。',
        ], [
            'status' => 'ステータス',
        ]);

        $reservation->update(['status' => $request->string('status')]);

        return Redirect::route('admin.reservations.show', $reservation)->with('status', 'ステータスを更新しました。');
    }

    private function contentFor(string $view): array
    {
        $defaults = [
            'home' => [
                'home.hero_title' => '四季を味わう和のダイニング',
                'home.hero_text' => '旬の食材を活かしたお料理と、落ち着いた和の空間で心地よいひとときをお過ごしください。',
                'home.hero_image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=900&q=80',
            ],
            'menu' => [
                'menu.heading' => '季節のおすすめ',
                'menu.items' => "旬野菜の炭火焼き盛り合わせ\n熟成牛のロースト 山椒ソース\n金目鯛の土鍋ごはん",
            ],
            'access' => [
                'access.heading' => 'アクセス',
                'access.address' => '東京都千代田区丸の内1-1-1',
                'access.hours' => '営業時間: 11:30-22:00 (L.O 21:00)',
                'access.map_embed' => 'https://maps.google.com/maps?q=tokyo&t=&z=13&ie=UTF8&iwloc=&output=embed',
            ],
            'contact' => [
                'contact.heading' => 'お問い合わせ',
                'contact.body' => 'お問い合わせはお電話(03-xxxx-xxxx)または店頭にて承ります。',
            ],
            'gallery' => [
                'gallery.heading' => 'ギャラリー',
                'gallery.images' => json_encode(array_fill(0, 6, 'https://images.unsplash.com/photo-1551218808-94e220e084d2?auto=format&fit=crop&w=600&q=80')),
            ],
            'reserve' => [],
        ];

        $contentValues = Content::valuesFor($defaults[$view] ?? []);

        return [
            'contentValues' => $contentValues,
            'galleryImages' => isset($contentValues['gallery.images']) ? json_decode($contentValues['gallery.images'], true) : [],
        ];
    }
}
