@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit: <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></h1>

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
        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                {{-- @error is a particular "if" that checks the condition of the '->validate([])' inside PostController store function  --}}
                {{-- the method 'old()' keeps the input and does not erase it when the page is refreshed --}}
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $post->title }}">
                @error('title')
                    <div class="text-danger">{{ old('title',$post->message) }}</div>
                @enderror
              </div>              
      
              <div class="mb-3">
                {{-- @error is a particular "if" that checks the condition of the '->validate([])' inside PostController store function  --}}
                {{-- the method 'old()' keeps the textarea content and does not erase it when the page is refreshed --}}
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror" rows="7">{{ old('content',$post->content) }}</textarea>
                @error('content')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="label-control" for="category_id">Category</label>
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                  <option value="">- select category</option>
                  @foreach ($categories as $category)
                      <option {{-- must use == instead of === because one is a string and the other is a number --}}
                      @if (old('category_id', $post->category->id) == $category->id)
                        selected    
                      @endif 
                      value="{{$category->id}}">{{ $category->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                    <p class="text-danger">
                      {{$message}}
                    </p>
                @enderror
              </div>
              
              <button type="submit" class="btn btn-primary">Submit</button>{{-- the button ridercts to the 'update' route in the PostController --}}
              <button type="reset" class="btn btn-secondary" type="reset">Reset</button>
        </form>
    </div>
</div>
@endsection
