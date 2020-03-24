<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function store($id)
    {
        //mentoggle untuk user yang sedang login mengikuti/tidak megikuti suatu kelompok
        $post = Post::find($id);
        return auth()->user()->following()->toggle($post);
    }

    public function notify()
    {
        //menampilkan user yang belum di acc
        $user = auth()->user()->posts()->follower();
        return response()->json(['user'=>$user]);
    }

    public function update(Request $request,$id)
    {
        //masukan berupa id yang akan di acc
        $deniedUser = User::find($id);
        $user = auth()->user()->posts()->follower()->find($id);
        if (request()->join_status == false){
            return auth()->user()->posts()->follower()->toogle($deniedUser);
        }else{
            $user->update($request);
            return response()->json('The post successfully updated');
        }
    }
}
