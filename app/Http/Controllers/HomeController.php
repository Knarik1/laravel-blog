<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\PostImage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PostConfirm;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
   }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user = Auth::user();

        $user = User::find($auth_user->id)->load('posts.images');

//        $one_user_posts = $user->posts()->with('images')->get();
//        $one_user_posts->user_email = $user['email'];
        return view('posts.show',compact('user'));
    }

    /**
     * form for the posts posting
     */
    public function create($id)
    {

        return view('posts.create',compact('id'));
    }

    /**
     * posts requests confirmation
     */
    public function store(Request $request)
    {
        $post_info = $request->all();
        
        $post = new Post();
        $post->heading = $post_info['heading'];
        $post->text = $post_info['text'];
        $post->color = $post_info['color'];
        $post->save();

        $files = $request->file('images');
        $files_count = count($files);
        $uploaded_files = 0;
        $imagesArray = [];

        if ($request->hasFile('images')){
            foreach ($files as $file){
            if ($file->isValid()){
                $rand = str_random(5,8);
                $name = $rand.'_'.$file->getClientOriginalName();
                
                $image = new PostImage();
                $image->image = $name;
                $imagesArray[] = $image;
                $file->move(public_path().'/images/', $name);
                $uploaded_files++;
                }
            }
        }

        $post->images()->saveMany($imagesArray);
//dd( $post->images()->saveMany($imagesArray));
        $user_new_post = Auth::user();
        $user_new_post->posts()->save($post);

        return redirect('/home');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
