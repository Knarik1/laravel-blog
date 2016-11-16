@extends('layouts.app')


@section('sidebar')
    @parent
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
                                    <th>heading</th>
                                    <th>text</th>
                                    <th>category</th>
                                    <th>tags</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>{{ $post['id'] }}</td>
                                        <td>{{ $post['heading'] }}</td>
                                        <td>{{ $post['text'] }}</td>
                                        <td>{{ $post['category']['name'] }}</td>
                                        <td>
                                            @foreach($post['tags'] as $tag)
                                                {{ $tag['name'] }}
                                            @endforeach
                                        </td>
                                    </tr>
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





