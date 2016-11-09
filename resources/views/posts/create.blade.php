@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/posts/store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('heading') ? ' has-error' : '' }}">
                            <label for="heading" class="col-md-4 control-label">Heading</label>

                            <div class="col-md-6">
                                <input name="heading" id="heading" value="{{ old('heading') }}"  autofocus>

                                @if ($errors->has('heading'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('heading') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-4 control-label">Text</label>

                            <div class="col-md-6">
                                <textarea name="text" id="text" cols="30" rows="10" value="{{ old('text') }}"></textarea>

                                @if ($errors->has('text'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="select-id" class="col-md-6 control-label"><h3>Choose your post category</h3></label>
                            <select class="form-control" id="select-id" name="cat">
                                @foreach($all_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="select-id" class="col-md-6 control-label"><h3>Choose your post tag</h3></label>
                            <select class="form-control" id="select-id" name="tag[]" multiple>
                                @foreach($all_tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                               @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="file" name="images[]" multiple accept="image/*"><br/>
                            <input type="color" name="color" value="#e5b4b4">
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
