<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //一覧表示
    public function index()
    {
        // $posts = Post::latest()->get();
        $posts = Post::latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    //新規作成
    function create(Request $request)
    {
        // return view('posts.create');
        $posts = Post::latest()->get();
        return view('posts.create', ['posts' => '$posts']);
    }

    public function store(Request $request)
    {
        // 1. 投稿を保存
        $post = new Post;
        $post->title = $request->title;
        $post->contents = $request->contents;
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.index');
    }


    //編集
    function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    //更新
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->contents = $request->contents;
        $post->save();

        return redirect()->route('posts.index');
    }


    //削除
    function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }

    //簡単検索
    public function search(Request $request)
    {
        $query = $request->input('query');

        // ページネーションを有効にして検索結果を取得
        $posts = Post::where('title', 'LIKE', "%$query%")
            ->orWhere('contents', 'LIKE', "%$query%")
            ->paginate(6); // 1ページに表示する投稿数を設定

        return view('search', compact('posts', 'query'));
    }
}
