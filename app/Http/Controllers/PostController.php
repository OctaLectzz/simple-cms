<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }


    public function list(Request $request)
    {

        $posts = Post::query()
                        ->when(!$request->order, function ($query) {
                            $query->latest();
                        });

        return datatables()
            ->eloquent($posts)
            ->addColumn('action', function ($post) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(event)" action="' . route('post.destroy', $post->id) . '" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                        <a href="' . route('post.edit', $post->id) . '" class="btn btn-sm btn-warning rounded"><i class="fa fa-edit"></i></a>
                        <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger mr-2">
                                <i class="fa fa-trash"></i>
                            </button>
                            </td>
                        </form>
                    </div>
                ';
            })
            ->addColumn('postImages', function ($post) {
                if ($post->postImages) {
                        return ' <img src="' . asset('storage/postImages/' . $post->postImages) . '" class="elevation-2" alt="User Image" width="60"> ';
                } else {
                        return '<img src="' . asset('vendor/admin-lte/img/user-profile-default.jpg') . '" class="elevation-2" alt="User Image" width="60"> ';
                }
            })
            ->editColumn('created_by', function ($post) {
                return auth()->user()->name;
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }


    public function create()
    {
        return view('post.create');
    }


    public function store(Request $request)
    {
        // Validate Request //
            $request->validate(
            [
                'title' => 'required|string',
                'content' => 'required',
                'postImages' => 'required|image|file|max:2048'
            ]
        );

        
        // Request postImages //
        $newPostImages = $request->postImages->getClientOriginalName();
        $request->postImages->storeAs('postImages', $newPostImages);
        $data = [
            'title' => $request->title,
            'content' =>$request->content,
            'created_by' => auth()->user()->name,
            'postImages' => $newPostImages
        ];

        $post = Post::create($data);

        return redirect('/post')->with('success', 'Post Created Successfully!');;
    }


    public function edit($id)
    {
        $post = Post::find($id);
        return view('post.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        // Validate Request //
        $validatedData = $request->validate(
            [
                'title' => 'required|string',
                'content' => 'required',
                'postImages' => 'required|image|file|max:2048'
            ]
        );

        
        $data = [
            'title' => $request->title,
            'content' =>$request->content,
            'created_by' => auth()->user()->name
        ];
        
        // Request postImages //
        $newPostImages = $request->postImages->getClientOriginalName();
        $request->postImages->storeAs('postImages', $newPostImages);
        $data = [
            'postImages' => $newPostImages
        ];


        $findPost = Post::find($post->id);
        $findPost->update($data);

        return redirect('/post')->with('success', 'Post Updated Successfully!');
    }


    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->back()->with('success', 'Post has been Deleted!');;
    }
}
