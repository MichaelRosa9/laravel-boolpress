@extends('layouts.app')

@section('content')
<div class="container">
    <h1>New Post</h1>

    {{-- error verification --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error )
            <li>
              {{ $error }}
            </li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="row col-8 offset-2">
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>

                {{-- @error is a particular "if" that checks the condition of the '->validate([])' inside PostController store function  --}}
                {{-- the method 'old()' keeps the input and does not erase it when the page is refreshed --}}
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"  value="{{ old('title') }}">
                @error('title')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>              
      
              <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                {{-- @error is a particular "if" that checks the condition of the '->validate([])' inside PostController store function  --}}
                {{-- the method 'old()' keeps the textarea content and does not erase it when the page is refreshed --}}
                <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror" rows="7">{{old('content')}}</textarea>
                @error('content')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary" type="reset">Reset</button>
        </form>
    </div>
</div>
@endsection
