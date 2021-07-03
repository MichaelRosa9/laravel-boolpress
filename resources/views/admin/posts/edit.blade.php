@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit: <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></h1>

    <div class="row col-8 offset-2">
        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}">
              </div>              
      
              <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control" rows="7">{{ $post->content }}</textarea>
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>{{-- the button ridercts to the 'update' route in the PostController --}}
              <button type="reset" class="btn btn-secondary" type="reset">Reset</button>
        </form>
    </div>
</div>
@endsection
