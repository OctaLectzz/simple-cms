<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function index()
    {
        return view('my-profile.index');
    }




    public function update(Request $request, User $name)
    {

        // Validate Request //
        $request->validate(
            [
                'images' => 'required',
                'name' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|string',
                'alamat' => 'required|string',
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
