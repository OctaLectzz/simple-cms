<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        // Short
        $categoriesName = null;
        $tagsName = null;
        $userName = null;
        if(request('category')) {
            $category = Category::firstWhere('name', request('category'));
            if ($category) {
                $categoriesName = $category->name;
            }
        }
        if(request('tag')) {
            $tag = Tag::firstWhere('name', request('tag'));
            if ($tag) {
                $tagsName = $tag->name;
            }
        }
        if(request('user')) {
            $user = User::firstWhere('name', request('user'));
            if ($user) {
                $userName = $user->name;
            }
        }

        // View
        $posts      = Post::latest()
                        ->where('is_pinned', false)
                        ->filter(request(['tag', 'category', 'user']))
                        ->paginate(6)
                        ->WithQueryString();
        $pinnedPost = Post::latest()
                        ->where('is_pinned', true)
                        ->filter(request(['tag', 'category', 'user']))
                        ->get();

        
        return view('welcome', compact('posts', 'pinnedPost'), [
            'user' => auth()->user(),
            'categoriesName' => $categoriesName,
            'tagsName' => $tagsName,
            'userName' => $userName
        ]);
    }


    public function show(Request $request, Post $post)
    {
        $comments = Comment::latest()->get();
        $url = url("/posts/{$post->slug}");

        if ($post->slug == $request->route('post.show', $post->slug)) {
            $post->views++;
            $post->save();
        }

        return view('postshow', compact('post', 'comments'), [
            'posts' => Post::inRandomOrder()->limit(10)->get(),
            'url' => $url
        ]);
    }


    
    public function update(Request $request)
    {
        // Validate Request //
        $data = $request->validate(
            [
                'name' => 'required|string',
                'email' => 'required|email',
                'tanggal_lahir' => '',
                'jenis_kelamin' => 'required',
                'alamat' => '',
            ]
        );

        $user = Auth::user();

        if ($request->hasFile('images')) {
            $newImage = $request->images->getClientOriginalName();
            $request->images->storeAs('images', $newImage);
            $data['images'] = $newImage;
        }

        $findUser = User::find($user->id);
        $findUser->update($data);

        return redirect()->back()->with('success', 'User Updated Successfully!');
    }
    
}
