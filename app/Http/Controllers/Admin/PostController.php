<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest; /* this line is required for the customized errors */
use Illuminate\Support\Str; /* this line is required for the 'slug' string function  */
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        /* remember to add a "protected $fillable = [...]" where inside the array there has to be the proper queries needed. in case do a dd() to see what elements does data have*/

        // this has been mooved to app/Http/Requests/PostRequest.php
        /* $request->validate([
            'title' => 'required|max:10',
            'content' => 'required|min:3'
        ]); */

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '-');

        /* check if slug name already exists and if so, ad a number that increments everytime the name is already used  */
        $slug_exist = Post::where('slug', $data['slug'])->first();
        $counter = 0;
        while($slug_exist){
            $title = $data['title'] . '-' . $counter;
            $slug = Str::slug($title, '-');
            $data['slug'] = $slug;
            $slug_exist = Post::where('slug',$slug)->first();
            $counter ++;
        }

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();
        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post){
            return view('admin.posts.show', compact('post'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if($post){
            return view('admin.posts.edit', compact('post'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        /* remember to add a "protected $fillable = [...]" where inside the array there has to be the proper queries needed. in case do a dd() to see what elements does data have*/
        $data = $request->all();
        
        if($post->title !== $data['title']){
            $slug = Str::slug($data['title'], '-');
            $slug_exist = Post::where('slug', $data['slug'])->first();
            $counter = 0;
            while($slug_exist){
                $title = $data['title'] . '-' . $counter;
                $slug = Str::slug($title, '-');
                $data['slug'] = $slug;
                $slug_exist = Post::where('slug',$slug)->first();
                $counter ++;
            }
        }else{
            $data['slug'] = $post->slug;
        }
        

        $post->update($data);

        return redirect()->route('admin.posts.show', $post); /* must use redirect before return in order to see the updated element */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);

    }
}
