@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    {{--{{ dd($user['posts']) }}--}}
                    @foreach($user['posts'] as $post)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>
                                {{ $post['heading'] }}
                                <span style="float: right">
                                <a href="{{ url('/post/show/') }}" class="btn btn-success" type="button">Show</a>
                                <a href="" class="btn btn-primary" type="button">Edit</a>
                                <a href="" class="btn btn-danger" type="button">Delete</a>
                                </span>
                            </h3>
                        </div>
                        <div class="panel-footer">
                            @foreach($post['images'] as $image)
                                {{--{{ dd($image) }}--}}
                            <img src="{{ asset('/images/'.$image['image']) }}" alt="" style="height: 40px">
                            @endforeach
                            <p>{{ $post['text'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



