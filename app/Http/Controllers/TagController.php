<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tag.index');
    }


    public function list()
    {
        return datatables()
            ->eloquent(Tag::query()->latest())
            ->addColumn('action', function ($tag) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(\'event\')" action="' . route('tag.destroy', $tag->id) . '" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                        <a href="' . route('tag.edit', $tag->id) . '" class="btn btn-sm btn-warning rounded"><i class="fa fa-edit"></i></a>
                        <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger mr-2">
                                <i class="fa fa-trash"></i>
                            </button>
                            </td>
                        </form>
                    </div>
                ';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }


    public function create()
    {
        return view('tag.create');
    }


    public function store(Request $request)
    {
        // Validate Request //
        $request->validate(
            [
                'name' => 'required|string',
            ]
        );

        $data = [
            'created_by' => auth()->user()->name,
            'name' => $request->name
        ];

        $tag = Tag::create($data);

        return redirect('/tag')->with('success', 'Tag Created Successfully!');
    }


    public function edit($id) 
    {
        $tag = Tag::find($id);
        return view('tag.edit', compact('tag'));
    }

    
    public function update(Request $request, Tag $tag)
    {

        // Validate Request //
        $request->validate(
            [
                'name' => 'required|string',
            ]
        );

        $data = [
            'name' => $request->name,
        ];


        $findTag = Tag::find($tag->id);
        $findTag->update($data);

        return redirect('/tag')->with('success', 'Tag Updated Successfully!');
    }

    
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->back()->with('success', 'User has been Deleted!');;
    }
}
