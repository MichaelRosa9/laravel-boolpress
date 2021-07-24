@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ $post->title }}</h1>

  <div>
    @if ($post->cover)
    <img src="{{ asset('storage/'. $post->cover) }}" alt="{{ $post->cover_original_name }}">
    <h5>{{ $post->cover_original_name }}</h5>      
    @endif
  </div>
  <h3>
    @if ($post->category)
      Category: {{ $post->category->name }}
    @else
      No Category
    @endif
  </h3>
  
  <div>
    @foreach($post->tags as $tag)
     <span class="badge badge-primary">{{ $tag->name }}</span>
    @endforeach
  </div>

  <p>{{ $post->content }}</p>
  
  <div>
    <a href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
  </div>
</div>
@endsection
