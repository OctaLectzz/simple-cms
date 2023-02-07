<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $users = Auth::user();
        return view('profile.user');
    }

    public function update(Request $request, User $name)
    {

        // Validate Request //
        $request->validate(
            [
                'name' => 'string',
                'tanggal_lahir' => 'date',
                'jenis_kelamin' => 'required',
                'alamat' => 'string',
                'images' => 'Required'
            ]
        );
          
        // Request Images //
        $filename = $request->images->getClientOriginalName();
        $request->images->storeAs('images', $filename);

        // if ($request->file('images')) {
        //     $extension = $request->file('images')->getClientOriginalName();
        //     $newImagesName = $request->name . '-' . now()->timestamp . '.' . $extension;
        //     $request->file('images')->storeAs('public', $newImagesName);

        //     $data = array_merge($data, [
        //         'images' => $newImagesName
        //     ]);
        // }




        $data = [
            'images' => $filename,
            'name' => $request->name,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ];


        $users = Auth::user();
        $findUser = User::find($users->id);
        $findUser->update($data);

        return redirect('home')->with('success', 'User Update Successfully');
    }
}
