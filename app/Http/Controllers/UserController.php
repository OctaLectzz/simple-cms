<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function edit()
    {
        $users = Auth::user();

        session::flash('username', $users->name);
        session::flash('tanggal_lahir', $users->tanggal_lahir);
        session::flash('jenis_kelamin', $users->jenis_kelamin);
        session::flash('alamat', $users->alamat);

        return view('profile.user', ['users' => $users]);
    }

    public function update(Request $request, User $name)
    {

        // Validate Request //
        $request->validate(
            [
                'name' => 'string',
                'tanggal_lahir' => 'date',
                'jenis_kelamin' => 'string',
                'alamat' => 'string',
            ]
        );


        // Request Images //
        if ($request->file('images')) {
            $extension = $request->file('images')->getClientOriginalExtension();
            $newImagesName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('images')->storeAs('images', $newImagesName);
        }
            
            
        $data = [
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'images' => $request->images
        ];

        $users = Auth::user();
        $findUser = User::find($users->id);
        $findUser->update($data);

        return redirect('home')->with('success', 'User Update Successfully');
    }
}
