<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyProfileController extends Controller
{
    public function index()
    {
        return view('my-profile.index');
    }




    public function update(Request $request, User $name)
    {

        // Validate Request //
        $data = $request->validate(
            [
                'images' => 'image|file|max:2048',
                'name' => 'required|string',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|string',
                'alamat' => 'required'
            ]
        );
          

        // Request Images //
        if ($request->hasFile('images')) {
            $newImage = $request->images->getClientOriginalName();
            $request->images->storeAs('images', $newImage);
            $data['images'] = $newImage;
        }
        

        $users = Auth::user();
        $findUser = User::find($users->id);
        $findUser->update($data);

        return redirect('home')->with('success', 'User Update Successfully');
    }

}
