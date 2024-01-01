@extends('layouts.app')

@section('title', 'post show')

@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $post->created_at->diffForHumans() }}
                    Category: <b>{{ $post->category->name }}</b>,
                    Author: <strong><a href="">{{ $post->user->name }}</a></strong>
                </div>
                <p class="card-text">{{ $post->body }}</p>
                <a class="btn btn-info" href="{{ route('all.posts') }}">
                    Back
                </a>
                <a class="btn btn-warning" href="{{ route('posts.delete', $post->id) }}">
                    Delete
                </a>

                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">edit</a>
            </div>
        </div>

        <ul class="list-group">
            <li class="list-group-item active">
                <b>Comments ({{ count($post->comments) }})</b>
            </li>

            <br>
            @if (Session::has('successMsg'))
                <div class="alert alert-success">
                    {{ Session::get('successMsg') }}
                </div>
            @endif

            @if (Session::has('deleteMsg'))
                <div class="alert alert-danger">
                    {{ Session::get('deleteMsg') }}
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-warning">
                    {{ Session::get('error') }}
                </div>
            @endif

            @foreach ($post->comments as $comment)
                <li class="list-group-item">
                    {{ $comment->content }}
                    <a href="{{ route('comments.destroy',$comment->id) }}" style="color: red" class="close">
                        &times;
                    </a>
                    <div class="small mt-2">
                        By <b style="color:red">{{ $comment->user->name }}</b>,
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
            @endforeach
        </ul>
        <br>
        <form action="{{ route('comments.store') }}" method="post">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <textarea name="content" class="form-control mb-2 @error('content') is-invalid @enderror" placeholder="New Comment"></textarea>
            @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
            <input type="submit" value="Add Comment" class="btn btn-secondary">
        </form>
    @endsection
