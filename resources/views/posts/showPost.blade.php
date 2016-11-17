@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="text-center text-primary">Edit Post</h3>
                    </div>

                    <div class="panel-body">

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="text-danger text-center">
                                    {{--{{ dd($post) }}--}}
                                    {{ $post['heading'] }}
                                </h3>
                            </div>
                            @if($post['images'])
                                <div class="text-center">
                                    @foreach($post['images'] as $image)
                                        <img src="{{ asset('/images/'.$image['image']) }}" alt="" style="height: 100px;">
                                    @endforeach
                                </div>
                            @endif
                           <p> {{ $post['text'] }} </p>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h1>Comments</h1>



                                <div class="container-div">
                            {{--{{ dd($post) }}--}}
                                    <div class="comments-well">
                                        @if(count($post['comments'])>0)
                                            @foreach($post['comments'] as $comment)
                                                <div class="well">
                                                    <button style="float: right">{{ $comment['user']['name']}}</button>
                                                    <button style="float: right">{{ $comment['created_at'] }}</button>
                                                    <p>{{ $comment['text'] }}</p>
                                                    <button class="btn btn-warning btn-sm for-reply-ajax-btn" formaction="{{ url('/comment/'.$comment['id']) }}">
                                                        reply
                                                    </button>
                                                    <div class="for-putting-recursion-div"></div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <form class="form-horizontal" role="form">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <textarea name="text" cols="80" rows="4" placeholder="comment ..." class="text-data-wall"></textarea>
                                                <span class="text-danger error-span-comments"></span>
                                                <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="belong_to_id" value="">
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-primary comment-submit-btn" formaction="{{ url('/comment') }}">
                                                    Post
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>



                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
