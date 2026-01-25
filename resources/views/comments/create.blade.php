@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/comment.css') }}">

    <div class="big-container">
        {{-- <div class="middle-container-1"> --}}
        {{-- <div class="small-container-1"> --}}
        <div class="content-container">
            <div class="image-name">
                <div class="image-container">
                    <a href="{{ route('show', [$post->user->id]) }}">
                        @if($post->user->avatar && file_exists(public_path($post->user->avatar)))
                            <img src="{{ asset($post->user->avatar) }}" alt="プロフィール画像" class="image-prpfile">
                        @else
                            <img src="{{ asset('img/default-avatar.png') }}" alt="デフォルトプロフィール画像" class="image-prpfile">
                        @endif
                    </a>
                </div>
                <div class="name-box">
                    <h3 class="name">{{ $post->user->name }}</h3>
                </div>
            </div>
            <div class="post-content-box">
                <div class="post-contents">
                    <div class="title">
                        <h4>タイトル：{{ $post->title }}</h4>
                    </div>
                    <p class="card-text">内容：{{ $post->contents }}</p>
                </div>
                <p>投稿日時：{{ $post->created_at }}</p>
            </div>
        </div>
        {{-- </div> --}}
        {{-- </div> --}}

        {{-- <div class="middle-container-2"> --}}
        <div class="comment-container">
            <form action="{{ route('comments.store') }}" method="post">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="comment-small-container">
                    <div class="form-group">
                        <h3>＜コメント＞</h3>
                        <div class="comment-text-box">
                            <textarea placeholder="内容" rows="5" name="body"class="comment-text" ></textarea>
                        </div>
                    </div>
                    <div class="post-buttons">
                        <button type="button" class="cancel"
                            onclick="window.location='{{ route('posts.index') }}'">カタリバに戻る</button>
                        <button type="submit" class="comment-button">投稿する</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- </div> --}}

    </div>
@endsection
