
@extends('layouts.app')
@section('title','Edit Post')
@section('content')
  <div class="card">
    <div class="card-body">
        <h2 class="card-titl">Edit Post</h2>
        <form action="{{route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-3">
                  <label for="Title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="Title" required value="{{$post->title}}" name="title">
                </div>
                <div class="mb-3">
                  <label for="Description" class="form-label">Description</label>
                  <textarea type="text" class="form-control" id="Description" required name="description">
                    {{$post->description}}
                  </textarea>
                </div>
                <div class="mb-3 ">
                    <label for="image" class="form-label">image</label>
                  <input type="file" class="form-check-file" id="image" name="image">
                  @if($post->image)
                  <img src="{{asset('images/' . $post->image)}}" alt="Post Image">
                  @endif
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{route('posts.index')}}" class="btn btn-secondary">Cancel</a>
              </form>
    </div>
  </div>
  @endsection