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
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">{{-- nctype="multipart/form-data" is required if immages need to be upladed --}}
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
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <div class="mb-3">
                <label class="label-control" for="category_id">Category</label>
                <select class="@error('category_id') is-invalid @enderror" name="form-control" id="category_id">
                  <option value="">- select category</option>
                  @foreach ($categories as $category)
                      <option {{-- must use == instead of === because one is a string and the other is a number --}}
                      @if (old('category_id') == $category->id)
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

              <div class="mb-3">
                <h5>Tags</h5>
                @foreach ($tags as $tag)
                    <span class="d-inline-block mr-3">
                      <input type="checkbox"
                      @if (in_array($tag->id, old('tags',[])))
                          checked
                      @endif 
                      value="{{ $tag->id }}"
                      name="tags[]" {{-- everytyme a checkbox is checked, this array gets filled with the id of the input --}}
                      id="tag{{ $loop->iteration}}">{{-- must write a string and then add loop->iteration as counter needed for checkboxes to give ID --}}
                      <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                    </span>
                @endforeach
                @error('tags')
                    <p class="text-danger">
                      {{$message}}
                    </p>
                @enderror
              </div>

              <div class="mb-3">
                <label for="cover" class="label-control">Image</label>                
                <input type="file" id="cover" name="cover" class="form-control @error('cover') is-invalid @enderror">
                @error('cover')
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-secondary" type="reset">Reset</button>
        </form>
    </div>
</div>
@endsection
