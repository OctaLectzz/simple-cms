<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit(Request $request)
    {
        $users = Auth::user();
        return view('profile.edit');
    }

    public function update(Request $request)
    {

        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'tanggal_lahir' => ['required', 'date'],
                'jenis_kelamin' => ['required'],
                'alamat' => ['required', 'string', 'max:255'],
            ]
        );
            
            
        $data = [
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ];

        $users = Auth::user();
        $findUser = User::find($users->id);
        $findUser->update($data);

        return redirect('home')->with('success', 'User Update Successfully');
    }
}
