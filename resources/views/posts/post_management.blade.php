@extends('layouts.app')

@section('sidebar')
    @parent
@endsection
@section('content')

    <div id="wrapper">
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>Post Management table</h1>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>heading</th>
                                    <th>manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post['id'] }}</td>
                                        <td>{{ $post['heading'] }}</td>
                                        <td>
                                            <a href="{{ route('post.show',$post['id']) }}" class="btn btn-primary">show</a>
                                            <a href="" class="btn btn-warning">edit</a>
                                            <a href="" class="btn btn-danger">delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

@endsection





