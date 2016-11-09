<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\PostImage;
use App\Category;
use App\Tag;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;


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

        $user = User::find($auth_user->id)->load('posts.images', 'posts.category', 'posts.tags');
//        $one_user_posts = $user->posts()->with('images')->get();
//        $one_user_posts->user_email = $user['email'];
        return view('posts.show')->with('user', $user);
                                  
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

        $cat_id = $post_info['cat'];
        $cat = Category::where('id', $cat_id)->first();

        $post->category()->associate($cat);



        if($post->save()) {

            $tag_id = $post_info['tag'];
            $post->tags()->attach($tag_id);
      
//        $post->belongs_category()->save($post_info['cat']);

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

            $post->images()->saveMany($imagesArray);
//dd( $post->images()->saveMany($imagesArray));
            $user_new_post = Auth::user();
            $user_new_post->posts()->save($post);
        } else {
            return view('errors.503');

        }

        return redirect('/home');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $auth_user = Auth::user();

//        $auth_user_post = User::where('id',$auth_user->id)
//                            ->whereHas('posts',function($query) use ($post_id) {
//                                    $query->where('id',$post_id);
//                            })->get();
        $post_item = Post::where('id',$post_id)->where('user_id',$auth_user->id)->first();
        $post_item->load('images');

        return view('posts.showPost',compact('post_item'));
    }
    public function destroy(Request $request,$post_id)
    {

        if($request->ajax()) {
            $auth_user = Auth::user();

            $post_item = Post::where('id', $post_id)
                ->where('user_id', $auth_user->id)
                ->first();


            if($post_item->delete())
            {
                return $post_id;
            }
            else{
                return Response::json(['error' => 'failed'],500);
            }

        }
    }
}
