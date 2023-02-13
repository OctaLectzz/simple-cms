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
            ->eloquent(User::query()->latest())
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
            ->addColumn('status', function ($user) {
                return $user->status == 'Active'
                ? '<p class="badge badge-pill badge-success">Active</p>' : '<p class="badge badge-pill badge-danger">Inactive</p>' ;
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
                'name' => 'required|string',
            ]
        );

        $data = [
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
