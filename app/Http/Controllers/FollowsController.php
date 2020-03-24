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

        $user = auth()->user()->posts()->follower()->find($id);

        $user->update($request);
        return response()->json('The post successfully updated');
    }

    public function delete($id)
    {
        //digunakan untuk menolak orang yang ingin join
        $deniedUser = User::find($id);
        return auth()->user()->posts()->follower()->toogle($deniedUser);
    }

}
