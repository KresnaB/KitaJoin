<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_result(Request $request)
    {
        if($request->has('post_name')){
            $query = $request->get('post_name');
            $searchResult = Post::where('post_name', 'LIKE', "%$query%")->get();

            if($searchResult == "[]"){
                $searchResult = Post::All();
            }
        }else{
            $searchResult = Post::All();
        }

        return response()->json($searchResult);
    }
    public function filter_result(Request $request){
        if($request->has('category')){
            $query = $request->get('category');
            $searchResult = Post::where('category', $query)->get();

            if($searchResult == "[]"){
                $searchResult = Post::All();
            }
        }else{
            $searchResult = Post::All();
        }
        return response()->json($searchResult);
    }
}
