<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index');
    }


    public function list()
    {
        return datatables()
            ->eloquent(Category::query())
            ->addColumn('action', function ($category) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(\'event\')" action="' . route('category.destroy', $category->id) . '" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                        <a href="' . route('category.edit', $category->id) . '" class="btn btn-sm btn-warning rounded"><i class="fa fa-edit"></i></a>
                        <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger mr-2">
                                <i class="fa fa-trash"></i>
                            </button>
                            </td>
                        </form>
                    </div>
                ';
            })
            ->editColumn('created_by', function ($category) {
                return auth()->user()->name;
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }


    public function create()
    {
        return view('category.create');
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

        $category = Category::create($data);

        return redirect('/category')->with('success', 'category Created Successfully!');
    }


    public function edit($id) 
    {
        $category = category::find($id);
        return view('category.edit', compact('category'));
    }

    
    public function update(Request $request, Category $category)
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


        $findcategory = Category::find($category->id);
        $findcategory->update($data);

        return redirect('/category')->with('success', 'Category Updated Successfully!');
    }

    
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category has been Deleted!');;
    }
}
