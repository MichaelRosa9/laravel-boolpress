@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ $post->title }}</h1>
  <h3>
    @if ($post->category)
      Category: {{ $post->category->name }}
  @else
    No Category
  @endif</h3>
  <p>{{ $post->content }}</p>
  <div>
    <a href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
  </div>
</div>
@endsection
