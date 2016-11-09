@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <div class="page-header">
                <h1 class="text-danger text-center">Edit the Post</h1>
            </div>
            <form action="{{ url('/post/'.$post['id']) }}" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="select-id">Choose your post category</label>
                    <select class="form-control" id="select-id" name="cat">
                        <option value="2">Sport</option>
                        <option value="4">Food</option>
                        <option value="1">Science</option>
                        <option value="5">News</option>
                        <option value="3">Cars</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Post Heading</label>
                    <input type="text" name="heading"  class="form-control" id="" placeholder="{{ $post['heading'] }}" value="{{ $post['heading'] }}">
                </div>
                <div class="form-group">
                    <label for="">Post Text</label>
                    <textarea class="form-control" name="text" id="" placeholder="{{ $post['text'] }}">{{ $post['text'] }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Post Images</label>
                    @if($post['images'])
                        <div class="row">
                            <div class="text-center">
                                @foreach($post['images'] as $image)
                                    <div class="col-md-2">
                                        <img src="{{ asset('/images/'.$image['image']) }}" alt="" style="height: 100px;"><br>

                                        <form action="{{ url('image/'.$image['id']) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <br>
                    <label for="">Add a picture</label>
                    <input type="file" id=""  name="images[]" multiple accept="image/*">
                </div>
                <div class="form-group">
                    <label for="">Post User color</label>
                    <input type="color" name="color" value="{{ $post['color'] }}">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
    </div>
    </div>
@endsection
