@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? "Edit post" : "Create post" }}
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title"
                           value="{{isset($post) ? $post->title : ""}}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30"
                              rows="10">{{isset($post) ? $post->description : ""}}</textarea>
                </div>


                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" value="{{isset($post) ? $post->content : "Editor content goes here"}}" type="hidden" name="content">
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" value="{{isset($post) ? $post->published_at : ""}}">
                </div>

                @if(isset($post))

                <div class="form-group">
                    <img src="{{asset('storage/' . $post->image)}}" alt="" style="width:100%" />
                </div>

                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                           value="{{isset($post) ? $post->image : ""}}">
                </div>

                <div class="form-group">
                    <button class="btn btn-success">{{ isset($post) ? "Update Post" : "Create Post" }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript">
        flatpickr('#published_at', {
            enableTime: true
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection