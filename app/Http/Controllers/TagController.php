<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('dashboard.tag.index');
    }


    public function list(Request $request)
    {

        $tag = Tag::query()
                        ->when(!$request->order, function ($query) {
                            $query->latest();
                        });

        return datatables()
            ->eloquent($tag)
            ->addColumn('action', function ($tag) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(event)" action="' . route('tag.destroy', $tag->id) . '" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                        <a href="' . route('tag.edit', $tag->id) . '" class="btn btn-sm btn-warning rounded mb-1"><i class="fa fa-edit"></i></a>
                        <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger mr-2 mb-1">
                                <i class="fa fa-trash"></i>
                            </button>
                            </td>
                        </form>
                    </div>
                ';
            })
            ->editColumn('created_by', function ($tag) {
                return auth()->user()->name;
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }


    public function create()
    {
        return view('dashboard.tag.create');
    }


    public function store(Request $request)
    {
        // Validate Request //
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'max:255'
            ]
        );

        $data = [
            'created_by' => auth()->user()->name,
            'name' => $request->name,
            'description' => $request->description,
        ];

        $tag = Tag::create($data);

        return redirect('/dashboard/tag')->with('success', 'Tag Created Successfully!');
    }


    public function edit($id) 
    {
        $tag = Tag::find($id);
        return view('dashboard.tag.edit', compact('tag'));
    }

    
    public function update(Request $request, Tag $tag)
    {

        // Validate Request //
        $request->validate(
            [
                'name' => 'required|string',
                'description' => 'max:255'
            ]
        );

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];


        $findTag = Tag::find($tag->id);
        $findTag->update($data);

        return redirect('/dashboard/tag')->with('success', 'Tag Updated Successfully!');
    }

    
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json(['success' => 'Post has been Deleted!']);
    }
}
