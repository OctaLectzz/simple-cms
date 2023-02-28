<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list()
    {
        return datatables()
            ->eloquent(User::query()->where('role', '!=', 'superAdmin')->latest())
            ->addColumn('action', function ($user) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(event)" action="' . route('user.destroy', $user->id) . '" method="POST">
                            <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                            <a href="' . route('user.edit', $user->id) . '" class="btn btn-sm btn-warning rounded"><i class="fa fa-edit"></i></a>
                            <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-danger mr-2">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </form>
                    </div>
                ';
            })
            ->addColumn('images', function ($user) {
                return ' <img src="' . asset('storage/images/' . $user->images) . '" class="img-circle elevation-2" alt="User Image" width="50" height="50"  style="border: 3px white solid"> ';
            })
            ->editColumn('status', function ($user) {
                return $user->status == 'Active'
                ? '<div class="text-center"><p class="p-2 px-3 fs-6 badge badge-success">Active</p></div>' 
                : '<div class="text-center"><p class="p-2 px-3 badge badge-danger">Blocked</p></div>' ;
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }



    public function index()
    {
        return view('dashboard.user.index');
    }



    public function create() 
    {
        return view('dashboard.user.create');
    }

    
    public function store(Request $request, User $user)
    {

        // Validate Request //
        $data = $request->validate(
            [
                'name' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]
        );
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'Admin';


        $user = User::create($data);

        return redirect('/dashboard/user')->with('success', 'User Created Successfully!');
    }


    public function edit($id) 
    {
        $user = User::find($id);
        return view('dashboard.user.edit', compact('user'));
    }

    
    public function update(Request $request, User $user)
    {

        // Validate Request //
        $data = $request->validate(
            [
                'images' => 'image|file|max:2048',
                'name' => 'required|string',
                'tanggal_lahir' => '',
                'jenis_kelamin' => 'required',
                'alamat' => '',
                'status' => 'required'
            ]
        );


        // Request Images //
        if ($request->hasFile('images')) {
            $newImage = $request->images->getClientOriginalName();
            $request->images->storeAs('images', $newImage);
            $data['images'] = $newImage;
        } else {
            $data['images'] = 'user-profile-default.jpg';
        }


        $findUser = User::find($user->id);
        $findUser->update($data);

        return redirect('/dashboard/user')->with('success', 'User Updated Successfully!');
    }

    
    public function destroy(User $user)
    {

        $user->delete();

        return response()->json(['success' => 'Post has been Deleted!']);
    }
}
