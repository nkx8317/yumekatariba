<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'posts';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:1024'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'occupation' => ['nullable', 'string', 'max:15'], // 職業のバリデーションルール
            'sns_link' => ['nullable', 'url', 'max:255'], // SNSリンクのバリデーションルール
            'introduction' => ['nullable', 'string', 'max:100'], // 自己紹介のバリデーションルール
    ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // 画像の処理
        $avatar = 'img/default-avatar.png'; // デフォルト画像を設定
        if (request()->hasFile('avatar')) {
            $file = request()->file('avatar');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            
            // ユニークなファイル名を生成（タイムスタンプ + ランダム文字列）
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            
            // 画像をpublic/img/avatarsに保存
            $file->move(public_path('img/avatars'), $fileName);
            $avatar = 'img/avatars/' . $fileName;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $avatar,
            'password' => Hash::make($data['password']),
            'occupation' => $data['occupation'], // 職業のフィールドを追加
            'sns_link' => $data['sns_link'], // SNSリンクのフィールドを追加
            'introduction' => $data['introduction'], // 自己紹介のフィールドを追加
        ]);
    }
}
