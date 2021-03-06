<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest; /* this line is required for the customized errors */
use App\Tag;
use Illuminate\Support\Str; /* this line is required for the 'slug' string function  */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
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
        /* dd($data); */
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


        /* IMPORTANT FOR UPLOADING FILES SUCH AS IMAGES*/
        if(array_key_exists('cover', $data)){ // inside this condition, the image uploaded is saved in the DB and in the upload folder

            $data['cover_original_name'] = $request->file('cover')->getClientOriginalName(); //this line gets the original name of the file uploaded

            $image_path = Storage::put('uploads', $data['cover']); //save the the file in storage and the path

            $data['cover'] = $image_path; //Insert the path in the filalble data
        } 


        $new_post = new Post();
        $new_post->fill($data);
        $new_post->save();

        //if the key 'tags' exists inside $data and only if something ii checked
        if(array_key_exists('tags', $data)){
            //fill the pivot table'post_tag' with the key of the post and the key of the tags
            $new_post->tags()->attach($data['tags']);
        }
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
        $tags = Tag::all();
        $categories = Category::all();
        if($post){
            return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
            $slug_exist = Post::where('slug', $slug)->first();
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
        
        /* IMPORTANT FOR UPLOADING FILES SUCH AS IMAGES*/
        if(array_key_exists('cover', $data)){ // inside this condition, the image uploaded is saved in the DB and in the upload folder

            if($post->cover){ //condition that removes previous image
                Storage::delete($post->cover);
            }

            $data['cover_original_name'] = $request->file('cover')->getClientOriginalName(); //this line gets the original name of the file uploaded

            $image_path = Storage::put('uploads', $data['cover']); //save the the file in storage and the path

            $data['cover'] = $image_path; //Insert the path in the filalble data
        } 

        $post->update($data);

        //similar condition used in the store function but instead of using method attach() i use method sync()
        if(array_key_exists('tags', $data)){
            //fill the pivot table'post_tag' with the key of the post and the key of the tags
            $post->tags()->sync($data['tags']);
        }else{
            $post->tags()->detach();
        }
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
        if($post->cover){
            Storage::delete($post->cover);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);

    }
}
