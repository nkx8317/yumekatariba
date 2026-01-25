<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    //
    public function store(Request $request)
    {
        // dd($request->tweet_id);
        $bookmark = new Bookmark();
        $bookmark->post_id = $request->post_id;
        $bookmark->user_id = Auth::user()->id;
        $bookmark->save();

        return redirect('/posts');
    }

    public function destroy(Request $request)
    {
        $bookmark = Bookmark::find($request->bookmark_id);
        $bookmark->delete();
        return redirect('/posts');
    }
}
