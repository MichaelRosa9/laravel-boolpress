@extends('layouts.app')

@section('content')
<div class="container">
    <h1>New Post</h1>

    <div class="row col-8 offset-2">
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="">
              </div>              
      
              <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control" rows="7"></textarea>
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
    </div>
</div>
@endsection
