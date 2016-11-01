@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @foreach($users as $user)
                        {{--{{ dd($user) }}--}}
                        @foreach($user['posts'] as $post)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h3>
                                        <span class="label" style="background-color: {{ $post['color'] }}">{{ $user['email'] }}</span>
                                        <small>{{ $post['created_at'] }}</small><br><br>
                                        {{ $post['heading'] }}
                                    </h3>
                                </div>

                                <div class="panel-footer">
                                    @foreach($post['images'] as $image)
{{--                                        {{ dd($image) }}--}}
                                        <img src="{{ asset('/images/'.$image['image']) }}" alt="" style="height: 40px">
                                    @endforeach
                                    <p>{{ $post['text'] }}</p>
                                </div>
                            </div>

                        @endforeach
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
