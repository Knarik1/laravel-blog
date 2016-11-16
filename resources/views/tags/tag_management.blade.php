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
                        <h1>Tag Management table</h1>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>description</th>
                                    <th>manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{ $tag['id'] }}</td>
                                        <td>{{ $tag['name'] }}</td>
                                        <td>{{ $tag['description'] }}</td>
                                        <td>
                                            <a href="" class="btn btn-primary">show</a>
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





