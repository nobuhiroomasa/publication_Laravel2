<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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

        return view('pages.' . $view);
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
}
