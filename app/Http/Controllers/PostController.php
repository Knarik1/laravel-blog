<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostImage;
use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only' => ['edit', 'update','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.post_management',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id)->load('tags','category');
        return view('posts.post_table',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id)->load('images');
        return view('posts.edit',compact('post'));
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
        $new_post = Post::find($id);
        $new_post['category_id'] = $request['cat'];
        $new_post->update($request->all());
        $new_post->save();

        $files = $request->file('images');
        $files_count = count($files);
        $uploaded_files = 0;
        $imagesArray = [];

        if ($request->hasFile('images')) {
            foreach ($files as $file) {
                if ($file->isValid()) {
                    $rand = str_random(5, 8);
                    $name = $rand . '_' . $file->getClientOriginalName();

                    $image = new PostImage();
                    $image->image = $name;
                    $imagesArray[] = $image;
                    $file->move(public_path() . '/images/', $name);
                    $uploaded_files++;
                }
            }

        }
        $new_post->images()->saveMany($imagesArray);
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
