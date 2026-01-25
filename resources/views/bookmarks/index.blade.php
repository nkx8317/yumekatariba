<!DOCTYPE html>
<html lang="ja">
@extends('layouts.app')
@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/bookmark_index.css') }}">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <script src="{{ asset('css/app.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    </head>

    <body>
    
        <h2 style="text-align: center;" class="ichiran">{{ $user->name }}が <i class="fas fa-handshake"></i>した投稿</h2> 
        @if ($bookmarkedPosts->isEmpty())
            <p class="not-exist">{{ $user->name }}が<i class="fas fa-handshake"></i>した投稿はありません。</p>
        @else
            <div class="big-container">
                @foreach ($bookmarkedPosts as $post)
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
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('tags.search', ['tag' => $tag->tag_name]) }}" class="btn btn-sm"
                                    style="background-color: #D8D8D8;">#{{ $tag->tag_name }}</a>
                            @endforeach
                            <p class="post-date">投稿日時：{{ $post->created_at }}</p>
                        </div>
                        <div class="buttons">
                            @if ($post->user_id == Auth::user()->id)
                                <a href="{{ route('posts.edit', $post->id) }}" class="edit-button">編集</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value='削除' class="delete"
                                        onclick='return confirm("本当に削除しますか？")'>

                                </form>
                            @endif

                            @if ($post->user->id !== Auth::user()->id)
                                <a href="{{ route('comments.create', ['post_id' => $post->id]) }}"
                                    class="comment-button">コメント投稿</a>
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
                            <h5 cass="comment-watch">コメント一覧</h5>
                        </a>

                    </div>
                @endforeach
        @endif
        </div>
        <div class="pagination-box">
            {{ $bookmarkedPosts->links() }}
        </div>
        <div class="back-box">
            <button type="button" class="back" onclick="history.back()">戻る</button>
        </div>

    </body>
@endsection

</html>
