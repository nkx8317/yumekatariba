<!DOCTYPE html>
<html lang="ja">
@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <script src="{{ asset('css/app.js') }}"></script>
    </head>

    <body>
        <header>
            <div class="header-left">
                <form action="{{ route('posts.search') }}" method="GET">
                    <input type="text" name="query" placeholder="検索キーワード" class="search-bar">
                    <button type="submit" class="search-button">検索</button>
                </form>
            </div>
            <div class="header-right">
                <button class="create-button">
                    <a href="{{ route('posts.create') }}">新規投稿</a>
                </button>
            </div>
        </header>
        <div class="big-container">
            @foreach ($posts as $post)
                <div class="post-box">

                    <div class="profile-box">
                        <div class="image-container">
                            <a href="{{ route('show', [$post->user->id]) }}">
                                @if($post->user->avatar && file_exists(public_path($post->user->avatar)))
                                    <img src="{{ asset($post->user->avatar) }}" alt="プロフィール画像">
                                @else
                                    <img src="{{ asset('img/default-avatar.png') }}" alt="デフォルトプロフィール画像">
                                @endif
                            </a>
                        </div>
                        <a href="{{ route('show', [$post->user->id]) }}" class="name-link">
                            <h3 class="name">{{ $post->user->name }}</h3>
                        </a>
                        <h3 class="occupation">{{ $post->user->occupation }}</h3>
                        <a href="{{ $post->user->sns_link }}" class="sns-icon">
                            @if (strpos($post->user->sns_link, 'youtube') !== false)
                                <i class="fab fa-youtube" style="color: red;"></i>
                            @elseif (strpos($post->user->sns_link, 'facebook') !== false)
                                <i class="fab fa-facebook" style="color: blue"></i>
                            @elseif (strpos($post->user->sns_link, 'instagram') !== false)
                                <i class="fab fa-instagram" style="color: rgb(251, 82, 214);"></i>
                            @elseif (strpos($post->user->sns_link, 'line') !== false)
                                <i class="fab fa-line" style="color: green;"></i>
                            @elseif (strpos($post->user->sns_link, 'twitter') !== false)
                                <i class="fab fa-twitter" style="color: rgb(56, 203, 233);"></i>
                            @else
                                <i class="fas fa-link" style="color: gray;"></i>
                            @endif
                        </a>
                    </div>

                    <div class="post-content-cover">
                        <div class="post-content">
                            <h2 class="title">{{ $post->title }}</h2>
                            <p class="contents">{{ $post->contents }}</p>
                        </div>
                                <p class="post-date">投稿日時：{{ $post->created_at }}</p>
                    </div>
                    <div class="buttons">
                        @if ($post->user_id == Auth::user()->id)
                            <a href="{{ route('posts.edit', $post->id) }}" class="edit-button">編集</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value='削除' class="delete" onclick='return confirm("本当に削除しますか？")'>
                            </form>
                        @endif

                        @if ($post->user->id !== Auth::user()->id)
                            <a href="{{ route('comments.create', ['post_id' => $post->id]) }}"
                                class="comment-button">コメント投稿
                            </a>
                        @endif



                        <div class="bookmark">
                            @if ($post->likedBy(Auth::user())->count() > 0)
                                <a href="/bookmarks/{{ $post->likedBy(Auth::user())->firstOrfail()->id }}"
                                    class="bookmark-icon "><i class="fas fa-handshake"></i></a>
                            @else
                                <a href="/posts/{{ $post->id }}/bookmarks" class="bookmark-icon "><i
                                        class="far fa-handshake"></i></a>
                            @endif
                            {{ $post->bookmarks->count() }}

                        </div>
                    </div>
                    <a href="{{ route('comments.showPostComments', $post) }}" class="comment-rink">
                        <h5 class="comment-watch">コメント一覧</h5>
                    </a>
                </div>
            @endforeach
            <div class="pagination-box">
                {{ $posts->links() }}
            </div>
        </div>
    </body>
@endsection

</html>
