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
        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('name', request('category'));
            $title = ' in ' . $category->name;
        }
        if(request('user')) {
            $user = User::firstWhere('user', request('user'));
            $title = ' by ' . $user->name;
        }


        $posts = Post::all();
        // $posts = Post::paginate(6)->withQueryString();


        return view('welcome', compact('posts'), [
            'title' => '',
            "posts"  => Post::latest()
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
