<?php

namespace App\Http\Controllers;

use App\profile;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index()
    {
        $profiles = Profile::all()->toArray();
        return array_reverse($profiles);
    }

    

    public function profile($id)
    {
        $profile = Profile::find($id);
        return response()->json($profile);
    }

    // public function add($id)
    // {
    //     $username = User::find($id);
        
    //     // $profile = new Profile([
    //     //     'name' => $username->pluck('name'),
    //     //     'interest' =>  $request->input('interest'),
    //     //     'department' =>  $request->input('department'),
    //     //     'program' =>  $request->input('program'),
    //     //     'semester' =>  $request->input('semester'),
    //     //     'ept' =>  $request->input('ept'),
    //     //     'ip' =>  $request->input('ip'),
    //     //     'contact' =>  $request->input('contact'),
    //     //     'experience' =>  $request->input('experience'),
    //     //     'desc' =>  $request->input('desc'),
    //     //     'bio' =>  $request->input('bio')
    //     // ]);
    //     // $profile->save();
    //     dd($username);

    //     //return response()->json('The profile successfully added');
    // }
    

    public function edit(Request $request,Profile $id)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $profile = Profile::find($id);
        $data = request()->validate([
            'interest' => 'required',
            'contact' => 'required',
            'bio' => '',
            'image' => 'image',
        ]);


        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');
        
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray = ['image'=> $imagePath ];
        }

        $profile->update(array_merge(
            $data,
            $imageArray ?? []
            
        ));
        return response()->json('The profile successfully updated');
    }
}
