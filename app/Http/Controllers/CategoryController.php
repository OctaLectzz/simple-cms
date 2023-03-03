<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.category.index');
    }


    public function list(Request $request)
    {

        $category = Category::query()
                        ->when(!$request->order, function ($query) {
                            $query->latest();
                        });

        return datatables()
            ->eloquent($category)
            ->addColumn('action', function ($category) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(event)" action="' . route('category.destroy', $category->id) . '" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                        <a href="' . route('category.edit', $category->id) . '" class="btn btn-sm btn-warning rounded mb-1"><i class="fa fa-edit"></i></a>
                        <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-sm btn-danger mr-2 mb-1">
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
        return view('dashboard.category.create');
    }


    public function store(Request $request)
    {
        // Validate Request //
        $request->validate(
            [
                'name' => 'required|string',
                'description' => 'max:255'
            ]
        );

        $data = [
            'created_by' => auth()->user()->name,
            'name' => $request->name,
            'description' => $request->description,
        ];

        $category = Category::create($data);

        return redirect('/dashboard/category')->with('success', 'category Created Successfully!');
    }


    public function edit($id) 
    {
        $category = category::find($id);
        return view('dashboard.category.edit', compact('category'));
    }

    
    public function update(Request $request, Category $category)
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


        $findcategory = Category::find($category->id);
        $findcategory->update($data);

        return redirect('/dashboard/category')->with('success', 'Category Updated Successfully!');
    }

    
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['success' => 'Post has been Deleted!']);
    }
}
