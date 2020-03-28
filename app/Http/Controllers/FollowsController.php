<?php

namespace App\Http\Controllers;

use DB;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store($id)
    {
        //mentoggle untuk user yang sedang login mengikuti/tidak megikuti suatu kelompok
        $post = Post::find($id);
        return auth()->user()->following()->toggle($post);
    }

    public function notify($post_id)
    {
        //menampilkan user yang belum di acc
        $follower = DB::table('post_user')->select('user_id', 'join_status')->where('post_id', $post_id)->get();
        return response()->json(['user'=>$follower]);
    }

    public function update($post_id , $user_id)
    {
        //masukan berupa id post yang  yang akan di acc
        $status = DB::table('post_user')->where('post_id', $post_id)->where('user_id', $user_id)->pluck('join_status');
        if($status == false){DB::table('post_user')->where('post_id', $post_id)->where('user_id', $user_id)->update(['join_status' => true]);}
        else{DB::table('post_user')->where('post_id', $post_id)->where('user_id', $user_id)->update(['join_status' => false]);}

        return response()->json('The join status successfully updated');
    }

//    public function delete($post_id , $user_id)
//    {
//        //digunakan untuk menolak orang yang ingin join
//        $deniedUser = User::find($user_id);
//        return Post::find($post_id)->followers()->toogle($deniedUser);
//    }

}
