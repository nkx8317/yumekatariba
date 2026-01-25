<!DOCTYPE html>
<html lang="ja">
@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    </head>

    <body>

        <h1>マイページ</h1>
        <div class="mypage">
            <div class="top-content">
                @if($user->avatar && file_exists(public_path($user->avatar)))
                    <img src="{{ asset($user->avatar) }}" alt="プロフィール画像" class="profile">
                @else
                    <img src="{{ asset('img/default-avatar.png') }}" alt="デフォルトプロフィール画像" class="profile">
                @endif
                <div class="name-occupation">
                    <h4 class="name"><span>名前：{{ $user->name }}</span></h4>
                    <h5 class="occupation"><span>職業：{{ $user->occupation }}</span></h5>
                </div>
                <a href="{{ $user->sns_link }}" class="sns-icon">
                    @if (strpos($user->sns_link, 'youtube') !== false)
                        <i class="fab fa-youtube" style="color: red;"></i>
                    @elseif (strpos($user->sns_link, 'facebook') !== false)
                        <i class="fab fa-facebook" style="color: blue"></i>
                    @elseif (strpos($user->sns_link, 'instagram') !== false)
                        <i class="fab fa-instagram" style="color: rgb(251, 82, 214);"></i>
                    @elseif (strpos($user->sns_link, 'line') !== false)
                        <i class="fab fa-line" style="color: green;"></i>
                    @elseif (strpos($user->sns_link, 'twitter') !== false)
                        <i class="fab fa-twitter" style="color: rgb(56, 203, 233);"></i>
                    @else
                        <i class="fas fa-link" style="color: gray;"></i>
                    @endif
                </a>
            </div>
            <div class="bottom-content">
                <div class="introduction">
                    <h5 class="myself">自己紹介</h5>
                    <p>{{ $user->introduction }}
                    </p>
                </div>
                <div class="watch-index">
                    <a href="{{ route('myposts', ['id' => $user->id]) }}" class="mypost">
                        <div class="mypost-box">
                            {{ $user->name }}の投稿
                        </div>
                    </a>

                    <a href="{{ route('user.bookmarks', ['id' => $user->id]) }}" class="mybookmark">
                        <div class="mybookmark-box">
                            私の
                            <i class="fas fa-handshake"></i>
                            一覧
                        </div>
                    </a>
                </div>
            </div>
            <div class="bottom-button-box">
                <div class="bottom-button">
                    <button type="button" class="back"
                        onclick="window.location.href = '{{ route('posts.index') }}'">カタリバに戻る</button>
                    @if ($user->id == Auth::user()->id)
                        <a href="{{ route('user.edit') }}" class="update">登録情報更新</a>
                    @endif
                </div>
            </div>
        </div>


    </body>
@endsection

</html>
