<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'posts' => Post::latest()->where('is_pinned', false)->paginate(6)->WithQueryString(),
            'pinnedPost' => Post::latest()->where('is_pinned', true)->get()
        ]);
    }


    public function show(Post $post)
    {
        return view('postshow', [
            'post'  => $post,
            'title' => 'Single Post'
        ]);
    }
}
