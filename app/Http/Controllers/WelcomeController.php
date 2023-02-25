<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $images = $request->file('images');
            $imagesName = time() . '.' . $images->getClientOriginalExtension();
            $images->storeAs('public/images', $imagesName);
            $data['images'] = $imagesName;
        }


        $findUser = User::find($user->id);
        $findUser->update($data);

        return redirect()->back()->with('success', 'User Updated Successfully!');
    }
    
    
    
    
    
}
