<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function like($id)
    {
        $post = Post::findOrFail($id);
        $like = $post->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where([
            'user_id' => auth()->id(),
            'post_id' => $id,
        ])->firstOrFail();

        $like->delete();

        return redirect()->back();
    }

}
