<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }
        if(request('user')) {
            $user = User::firstWhere('username', request('user'));
            $title = ' by ' . $user->name;
        }
        
        return view('welcome', [
            'title' => 'Posts' . $title,
            'posts' => Post::latest()->where('is_pinned', false)->filter(request(['search', 'category', 'created_by']))->paginate(6)->WithQueryString(),
            'pinnedPost' => Post::latest()->where('is_pinned', true)->get()
        ]);
    }


    public function show(Post $post)
    {
        $comments = Comment::all();

        return view('postshow', compact('comments'), [
            'post'  => $post,
            'title' => 'Single Post'
        ]);
    }
}
