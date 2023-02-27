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

        
        return view('welcome', [
            'categoriesName' => $categoriesName,
            'tagsName' => $tagsName,
            'userName' => $userName,
            'posts' => Post::latest()->where('is_pinned', false)->filter(request(['tag', 'category', 'user']))->paginate(6)->WithQueryString(),
            'pinnedPost' => Post::latest()->where('is_pinned', true)->filter(request(['tag', 'category', 'user']))->get()
        ]);
    }


    public function show(Post $post)
    {
        $comments = $post->comments()->latest()->get();

        return view('postshow', compact('post', 'comments'));
    }


    
    public function update(Request $request, $id)
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
