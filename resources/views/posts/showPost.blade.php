@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="text-center text-primary">Edit Post</h3></div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="text-danger text-center">
                                    {{--{{ dd($post_item['images']) }}--}}
                                    {{ $post_item['heading'] }}
                                </h3>
                            </div>
                            @if($post_item['images'])
                                <div class="text-center">
                                    @foreach($post_item['images'] as $image)
                                        <img src="{{ asset('/images/'.$image['image']) }}" alt="" style="height: 100px;">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="panel-footer">
                            {{ $post_item['text'] }}
                        </div>
                    </div>
                    {{--{{ dd($post_item) }}--}}

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
