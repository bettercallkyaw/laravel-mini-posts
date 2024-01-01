@extends('layouts.app')

@section('title','edit post')


@section('content')
<div class="container">
<form action="{{ route('posts.update',$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
            value="{{ $post->title }}">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea name="body" class="form-control @error('body') is-invalid @enderror">{{ $post->body }}</textarea>
            @error('body')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">
                        {{ $category['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>
        <a class="btn btn-info" href="{{ route('all.posts') }}">
            Back
        </a>
        <input type="submit" value="Update Post" class="btn btn-primary">
    </form>
</div>
@endsection