<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function list()
    {
        return datatables()
            ->eloquent(User::query()->latest())
            ->addColumn('action', function ($user) {
                return '
                    <div class="d-flex">
                        <form action="' . route('user.destroy', $user->id) . '" method="POST">
                        <input type="hidden" name="_token" value="'. @csrf_token() .'" enctype="multipart/form-data">
                        <a href="' . route('my.profile.index') . '" class="btn btn-sm btn-warning rounded"><i class="fa fa-edit"></i></a>
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
                ? '<p class="text-success fw-bold text-center">Active</p>' : '<p class="text-danger fw-bold text-center">Inactive</p>' ;
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->toJson();
    }



    public function index()
    {
        return view('user.index');
    }


    
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User has been Deleted!');;
    }
}
