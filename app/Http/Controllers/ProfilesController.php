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
        //return view('profiles.index', compact('user'));
    }

    public function users()
    {
        $profiles = Profile::latest()->get();
        $users = User::latest()->get();
        return response()->json(['users'=>$users,'profiles'=>$profiles,]);
    }

    public function profile(User $id)
    {
        $user = User::find($id);
        $profile = Profile::find($id);
        return response()->json(['user'=>$user,'profile'=>$profile]);
    }

    // public function edit(User $user)
    // {
    //     $this->authorize('update', $user->profile);

    //     return view('profiles.edit', compact('user'));
    // }

    public function edit(Request $request,Profile $id)
    {
        $id->update([
            'interest' => $request->interest,
            'department' => $request->department,
            'program' => $request->program,
            'semester' => $request->semester,
            'ept' => $request->ept,
            'ip' => $request->ip,
            'contact' => $request->contact,
            'experience' => $request->experience,
            'desc' => $request->desc,
            'bio' => $request->bio,
        ]);
        //return response()->json('id',$id);
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
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


        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');
        
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image'=> $imagePath ];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
            
        ));
        $profile= Profile::find($id);
        return response()->json($profile);
    }
}
