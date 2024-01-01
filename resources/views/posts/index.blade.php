@extends('layouts.app')

@section('title','all posts')

@section('content')
<div class="container">
    
    @if (Session::has('successMsg'))
        <div class="alert alert-success">
         {{ Session::get('successMsg') }}
        </div>
    @endif

    @if (Session::has('alertMsg'))
        <div class="alert alert-danger">
            {{ Session::get('alertMsg') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-warning">
            {{ Session::get('error') }}
        </div>
    @endif

    @foreach($posts as $post)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $post->created_at->diffForHumans() }}
                    Author: <strong><a href="">{{ $post->user->name }}</a></strong>
                </div>

                <p class="card-text">{{ Str::substr($post->body,0,80) }}</p>
                <a class="card-link" href="{{ url('posts/show',$post->id) }}">
                    View Detail &raquo;
                </a>
            </div>
        </div>
 
    @endforeach    
    <br>
  {{ $posts->links() }}
    
</div>
@endsection