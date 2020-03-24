<?php

namespace App\Http\Controllers;

use App\profile;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $profiles = Profile::all()->toArray();
        return array_reverse($profiles);
    }

    // public function users()
    // {
    //     $profiles = Profile::latest()->get();
    //     $users = User::latest()->get();
    //     return response()->json(['users'=>$users,'profiles'=>$profiles,]);
    // }

    public function profile($id)
    {
        $profile = Profile::find($id);
        return response()->json(['profile'=>$profile]);
    }

    // public function edit(User $user)
    // {
    //     $this->authorize('update', $user->profile);

    //     return view('profiles.edit', compact('user'));
    // }

    public function edit(Request $request,Profile $id)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $profile = Profile::find($id);
        $validatedData = $request->validate([
            'name' => '',
            'interest' => 'required',
            'department' => 'required',
            'program' => 'required',
            'semester' => 'required|numeric|min:1|max:8',
            'ept' => 'numeric|min:0|max:700',
            'ip' => 'numeric|min:0|max:4',
            'contact' => 'required',
            'experience' => '',
            'desc' => '',
            'bio' => '',
            'image' => '',
        ]);
        $profile->update($validatedData->all());
        return response()->json('The book successfully updated');
    }
}
