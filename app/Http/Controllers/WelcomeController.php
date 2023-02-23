<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }
        if(request('tag')) {
            $tag = Tag::firstWhere('slug', request('tag'));
            $title = ' in ' . $tag->name;
        }
        if(request('user')) {
            $user = User::firstWhere('name', request('user'));
            $title = ' by ' . $user->name;
        }

        $posts = Post::all();


        return view('welcome', compact('posts'), [
            "title" => "Posts" . $title,
            "posts"  => Post::latest()->filter(request(['search', 'category', 'created_by']))->paginate(7)->withQueryString()
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
