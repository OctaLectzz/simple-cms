<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        if ($request->input('parent_id')) {
            $parentComment = Comment::findOrFail($request->input('parent_id'));
            $comment = $parentComment->replies()->create([
                'content' => $request->input('content'),
                'user_id' => Auth::user()->id,
                'post_id' => null
            ]);
        } else {
            // $comment = Comment::create($data);
            $comment = Comment::create([
                'content' => $request->input('content'),
                'user_id' => auth()->user()->id,
                'post_id' => $request->input('post_id')
            ]);
        }
        
    
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
