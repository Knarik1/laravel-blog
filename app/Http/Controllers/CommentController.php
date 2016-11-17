<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(78);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()) {
            $this->validate($request, [
                'text' => 'required',
            ]);
            $data = $request->all();
//        $comment = Comment::create($data);
            $comment = new Comment();
            $comment->text = $data['text'];

            $post_id = $data['post_id'];
            $post = Post::find($post_id);
            $comment->post()->associate($post);

            $user_id = $data['user_id'];
            $user = User::find($user_id);
            $comment->user()->associate($user);

            if(!empty($data['belong_to'])) {
                $belong_to = $data['belong_to'];
                $comment_belong = Comment::find($belong_to);
                $comment->belong_to_comment()->associate($comment_belong);
            }
            if($comment->save()){
                return json_encode($comment);
            } else {
                return redirect()->back();
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $comment_id)
    {
        if ($request->ajax()) {
            $comment = Comment::find($comment_id);
            $comment_replies = $comment->load('replies', 'replies.user');
            return json_encode($comment_replies);
        }
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
        //
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
    public function createComment($post_id)
    {
        return view('comments.create', compact('post_id'));
    }
}
