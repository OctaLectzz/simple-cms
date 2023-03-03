<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
            'images' => 'image|max:2048'
        ]);
    
        $data['user_id']  = auth()->id();

        $comment = Comment::create($data);
    
        return redirect()->back()->with('success', 'Comment Created Successfully!');
    }


    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'content' => 'required|string|max:255',
            'images' => 'image|max:2048'
        ]);
        $data['user_id']  = auth()->id();

        $comment->update($data);

        return redirect()->back()->with('success', 'Comment Updated Successfully');
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json([
            'success' => 'Comment Deleted Successfully'
        ]);
    }
}
