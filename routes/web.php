<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//投稿一覧表示
Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');

//投稿の新規作成
Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts.create');

//ポスト保存
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');

//ポスト編集
Route::get('/posts/{id}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');

//ポスト変更更新
Route::put('posts/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');

//ポスト削除
Route::delete('/posts/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy');

// 簡易検索
Route::get('/posts/search', [App\Http\Controllers\PostController::class, 'search'])->name('posts.search');

//ブックマーク作成
Route::get('posts/{post_id}/bookmarks', [App\Http\Controllers\BookmarkController::class, 'store']);

//ブックマークを取り消す
Route::get('bookmarks/{bookmark_id}', [App\Http\Controllers\BookmarkController::class, 'destroy']);

//コメント機能
Route::get('/comments/create/{post_id}',[App\Http\Controllers\CommentController::class, 'create'])->name('comments.create');

Route::post('/comments',[App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

//コメントしたコメント一覧表示
Route::get('/comments/show/{id}', [App\Http\Controllers\CommentController::class, 'show'])->name('comments.show');

// コメント一覧表示
Route::get('/comments/show-post-comments/{post}', [App\Http\Controllers\CommentController::class, 'showPostComments'])->name('comments.showPostComments');

//コメント削除
Route::delete('/comments/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

// 検索機能
Route::get('/posts/search', [App\Http\Controllers\PostController::class, 'search'])->name('posts.search');

// ユーザー詳細ページ
Route::get('/user/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('show');

// 登録情報の編集
Route::get('/user/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');

// 登録情報の変更更新
Route::put('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

// ブックマーク一覧表示
Route::get('/user/{id}/bookmarks',[App\Http\Controllers\UserController::class, 'showBookmarkedPosts'] )->name('user.bookmarks');

//自分のマイページ表示
Route::get('/myshow',[App\Http\Controllers\UserController::class, 'myshow'])->name('myshow');

//自分の投稿表示
Route::get('/user/{id}/myposts',[App\Http\Controllers\UserController::class, 'myPosts'])->name('myposts');
// タグのルーティングはまだ書いてないのでそこんとこお願いします。