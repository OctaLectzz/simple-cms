<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Comment $comment)
    {
        return view('postshow', compact('comment'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);
    
        $data['user_id']  = auth()->id();

        $comment = Comment::create($data);
    
        return redirect()->back()->with('success', 'Comment Created Successfully!');
    }


    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'content' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);
        $data['user_id']  = auth()->id();

        $comment->update($data);
    
        return redirect()->back()->with('success', 'Comment Created Successfully!');
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}
