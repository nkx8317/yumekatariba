<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function create($post_id)
    {
        $post = Post::find($post_id);
        return view('comments.create', compact('post'));
    }

    public function store(Request $request)
    {
        $post = Post::find($request->post_id);
        $comment = new Comment;
        $comment -> body = $request -> body;
        $comment -> user_id = Auth::id();
        $comment -> post_id = $request -> post_id;
        $comment -> save();
    
        return redirect()->route('comments.showPostComments',$post->id);
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        $post = $comment-> post;  
        // return view('comments.show', compact('comment', 'post'));
        $comments = $post->comments;
        // return view('comments.show', compact('post', 'comments'));
        return redirect()->route('comments.showPostComments',$post->id);
    }

    public function showPostComments(Post $post)
    {
        $comments = $post->comments;
        return view('comments.show', compact('post', 'comments'));
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('posts.index')->with('error', 'コメントが見つかりません');
        }

        if (Auth::id() === $comment->user_id) {
            $comment->delete();
            return redirect()->route('comments.showPostComments', $comment->post->id)->with('success', 'コメントが削除されました');
        } else {
            return redirect()->route('comments.showPostComments', $comment->post->id)->with('error', 'コメントを削除する権限がありません');
        }
    }


}
