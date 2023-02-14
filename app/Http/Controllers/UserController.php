<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        return datatables()
            ->eloquent(User::query()->where('role', '!=', 'superAdmin')->latest())
            ->addColumn('action', function ($user) {
                return '
                    <div class="d-flex">
                        <form onsubmit="destroy(\'event\')" action="' . route('user.destroy', $user->id) . '" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                        <a href="' . route('user.edit', $user->id) . '" class="reload btn btn-sm btn-warning rounded"><i class="fa fa-edit"></i></a>
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
                if ($user->images) {
                        return ' <img src="' . asset('storage/images/' . $user->images) . '" class="img-circle elevation-2 img-thumbnail" alt="User Image" width="50" height="50"> ';
                } else {
                        return '<img src="' . asset('vendor/admin-lte/img/user-profile-default.jpg') . '" class="img-circle elevation-2 img-thumbnail" alt="User Image" width="50" height="50"> ';
                }
            })
            ->editColumn('status', function ($user) {
                return $user->status == 'Active'
                ? '<div class="text-center"><p class="p-2 px-3 fs-6 badge badge-pill badge-success">Active</p></div>' : '<div class="text-center"><p class="p-2 px-3 badge badge-pill badge-danger">Blocked</p></div>' ;
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }



    public function index()
    {
        return view('user.index');
    }



    public function edit($id) 
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        // Validate Request //
        $request->validate(
            [
                'images' => 'required|image|max:2048',
                'name' => 'required|string',
            ]
        );

        // Request Images //
        $filename = $request->images->getClientOriginalName();
        $request->images->storeAs('images', $filename);

        // if ($request->images) {
        //     return ' <img src="' . asset('storage/images/' . $user->images) . '" class="img-circle elevation-2 img-thumbnail" alt="User Image" width="50" height="50"> ';
        // } else {
        //     return '<img src="' . asset('vendor/admin-lte/img/user-profile-default.jpg') . '" class="img-circle elevation-2 img-thumbnail" alt="User Image" width="50" height="50"> ';
        // }

    

        $data = [
            'images' => $filename,
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'status' => $request->status
        ];




        $findUser = User::find($user->id);
        $findUser->update($data);

        return redirect('/user')->with('success', 'User Updated Successfully!');
    }
    
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User has been Deleted!');;
    }
}
