@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="text-center text-primary">My Posts </h3></div>
                <div class="panel-body">
                    @foreach($user['posts'] as $post)
                        {{--{{ dd($user['posts'][3]['tags']) }}--}}
                    <div class="panel panel-default anime" id="panel-div-id-{{ $post['id'] }}">
                        <div class="panel-body">
                            <button class="btn btn-default btn-sm" type="button">category : {{ $post['category']['name'] }}</button>
                            @foreach($post['tags'] as $tag)
                                <button class="btn btn-default btn-sm" type="button">tag : {{ $tag['name'] }}</button>
                             @endforeach
                            <h3>
                                {{ $post['heading'] }}
                                <span style="float: right">
                                    <a href="{{ url('/posts/show/'.$post['id']) }}" class="btn btn-success" type="button">Show</a>
                                    <a href="{{ url('/post/'.$post['id'].'/edit') }}" class="btn btn-primary" type="button">Edit</a>
                                    <button class="btn btn-danger" type="button" id="delete-this-record" data-delete-id="{{ $post['id'] }}" formaction="{{ url('/posts/'.$post['id']) }}">Delete</button>
                                </span>
                            </h3>
                        </div>
                        <div class="panel-footer">
                            @foreach($post['images'] as $image)
                                <img src="{{ asset('/images/'.$image['image']) }}" alt="" style="height: 40px">
                            @endforeach
                            <p>{{ $post['text'] }}</p>
                                    <button class="btn btn-warning btn-sm" type="button" id="btn-comments">
                                        Comments <span class="badge">{{ (count($post['comments'])) }}</span>
                                    </button>
                        </div>
                    </div>
                    @endforeach
                </div>



            </div>
        </div>
    </div>
</div>
@endsection



