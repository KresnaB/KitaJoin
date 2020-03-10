<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->toArray();
        return array_reverse($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $user = User::find($id);
        // $post  = request([
        //     'post_name'=> $request->input('post_name'),
        //     'location'=> $request->input('location'),
        //     'type'=> $request->input('type'),
        //     'category'=>$request->input('category'),
        //     // 'poster'=$request->input('post_name');
        //     'description'=> $request->input('description')
        // ]);
        // user()->posts()->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->id == 1){
            $data = request()->validate([
                'post_name'=> 'required',
                'location'=> 'required',
                'type'=> 'required',
                'category'=> 'required',
                'image' => 'required|image',
            ]);
            $imagePath = request('image')->store('uploads', 'public');
            $imageExactPath = "storage/".$imagePath;
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
            $image->save();
            $imageArray = ['image'=>$image];
            
            auth()->user()->posts()->create(array_merge(
                $data,
                $imageArray
            ));

            return response()->json("post created");
        }else{
            return response()->json("not an admin");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json(['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $data = request()->validate([
            'post_name'=> 'required',
            'location'=> 'required',
            'type'=> 'required',
            'category'=> 'required',
        ]);

        $post->update($data);
        return response()->json('The post successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json("post successfully deleted");
    }
}
