@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>
                        {{ $post->id }}
                    </td>
                    <td>
                        {{ $post->title }}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{route('admin.posts.show', $post)}}">Show</a>
                    </td>
                    <td>
                        <a class="btn btn-link" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                DELETE
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
