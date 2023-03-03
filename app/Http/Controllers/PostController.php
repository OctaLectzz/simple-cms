<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function index()
    {
        return view('dashboard.post.index');
    }


    public function list(Request $request)
    {

        $posts = Post::query()
                        ->when(!$request->order, function ($query) {
                            $query->latest();
                        });

        return datatables()
            ->eloquent($posts)
            ->addColumn('is_pinned', function($post) {
                if ($post->is_pinned == 0) {
                    return '';
                } else {
                    return '<i class="bi bi-pin-angle-fill ms-2"></i>';
                }
            })
            ->addColumn('action', function ($post) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(event)" action="' . route('post.destroy', $post->id) . '" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                        <a href="' . route('post.edit', $post->id) . '" class="btn btn-sm btn-warning rounded mb-1"><i class="fa fa-edit"></i></a>
                        <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger mr-2 mb-1">
                                <i class="fa fa-trash"></i>
                            </button>
                            </td>
                        </form>
                    </div>
                ';
            })
            // ->addColumn('postImages', function ($post) {
            //     if ($post->postImages) {
            //             return ' <img src="' . asset('storage/postImages/' . $post->postImages) . '" class="elevation-2" alt="User Image" width="60"> ';
            //     } else {
            //             return '<img src="' . asset('vendor/admin-lte/img/user-profile-default.jpg') . '" class="elevation-2" alt="User Image" width="60"> ';
            //     }
            // })
            ->editColumn('created_by', function ($post) {
                return auth()->user()->name;
            })
            ->editColumn('views', function ($post) {
                return '<div class="text-center me-4">'. $post->views .'</div>';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }


    public function create(Post $post)
    {
        return view('dashboard.post.create', compact('post'), [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }


    public function store(Request $request)
    {
        // Validate Request //
        $data = $request->validate(
            [
                'is_pinned' => 'boolean',
                'title' => 'required|string',
                'slug' => 'required|unique:posts',
                'content' => 'required',
                'categories' => 'required',
                'tags' => 'required',
                'postImages' => 'required|image|file|max:2048'
            ]);
            $data['created_by'] = auth()->user()->name;

        
        // Request postImages //
        if ($request->hasFile('postImages')) {
            $newPostImages = $request->postImages->getClientOriginalName();
            $request->postImages->storeAs('postImages', $newPostImages);
            $data['postImages'] = $newPostImages;
        }

        $post = Post::create($data);
        $post->category()->attach($request->categories);
        $post->tag()->attach($request->tags);

        return redirect('/dashboard/post')->with('success', 'Post Created Successfully!');
    }


    public function edit($id)
    {
        $post = Post::find($id);
        return view('dashboard.post.edit', compact('post'), [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }


    public function update(Request $request, Post $post)
    {
        // Validate Request Data //
        $data = $request->validate(
            [
                'is_pinned' => 'boolean',
                'title' => 'required|string',
                'content' => 'required',
                'categories' => 'required',
                'tags' => 'required',
                'postImages' => 'image|file|max:2048'
            ]);
            $data['created_by'] = auth()->user()->name;

        
        // Request postImages //
        if ($request->hasFile('postImages')) {
            $newPostImages = $request->postImages->getClientOriginalName();
            $request->postImages->storeAs('postImages', $newPostImages);
            $data['postImages'] = $newPostImages;
        }


        $post->category()->sync($request->categories);
        $post->tag()->sync($request->tags);
        $post->update($data);

        return redirect('/dashboard/post')->with('success', 'Post Updated Successfully!');
    }


    public function destroy(Post $post)
    {
        // $path = public_path('storage/postImages' . $post->postImages);
        // if (File::exists($path)) {
        //     File::delete($path);
        // }

        $post->category()->detach();
        $post->tag()->detach();
        $post->delete();

        return response()->json(['success' => 'Post has been Deleted!']);
    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}