<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function store($id)
    {
        $post = Post::find($id);
        return auth()->user()->following()->toggle($post);
    }
}
