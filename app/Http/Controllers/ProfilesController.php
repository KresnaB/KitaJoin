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
        return response()->json(['profile'=>$profile]);
    }

    public function edit(Request $request,Profile $id)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $profile = Profile::find($id);
        $data = request()->validate([
            'interest' => 'required',
            'department' => 'required',
            'program' => 'required',
            'semester' => 'required|numeric|min:1|max:8',
            'ept' => 'numeric|min:0|max:700',
            'ip' => 'numeric|min:1|max:4',
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

        $profile->update(array_merge(
            $data,
            $imageArray ?? []
            
        ));
        return response()->json('The profile successfully updated');
    }
}
