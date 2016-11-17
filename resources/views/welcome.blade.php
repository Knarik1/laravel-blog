@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @foreach($users as $user)
                        @foreach($user['posts'] as $post)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <button class="btn btn-primary btn-sm" type="button">category : {{ $post['category']['name'] }}</button>
                                    <h3>
                                        <span class="label" style="background-color: {{ $post['color'] }}">{{ $user['email'] }}</span>
                                        <small>{{ $post['created_at'] }}</small><br><br>
                                        {{ $post['heading'] }}
                                    </h3>
                                </div>

                                @if(count($post['images'])>0)

                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        @foreach($post['images'] as $key => $image)
                                            @continue($key == 0)
                                            <li data-target="#myCarousel" data-slide-to="{{ $key }}"></li>
                                        @endforeach
                                    </ol>

                                    <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">

                                            <div class="item active">
                                                @foreach($post['images'] as $key => $image)
                                                    @if($key ==0)
                                                        <div class="item active">
                                                            <img src="{{ asset('/images/'.$image['image']) }}" alt="" style="height: 150px; width:800px">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                            @foreach($post['images'] as $key => $image)
                                                @continue ($key == 0)
                                                <div class="item">
                                                    <img src="{{ asset('/images/'.$image['image']) }}" alt="" style="height: 150px;">
                                                </div>
                                            @endforeach

                                        </div>


                                                <!-- Left and right controls -->
                                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>

                                </div>
                                @endif
                                <!--end of the carousel-->

                                <div class="panel-footer">
                                    <p>{{ $post['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                        {{ $users->links() }}
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#myCarousel").carousel({
                interval : 3000,
                pause: false
            });
        });
    </script>
@endsection

