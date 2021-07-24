<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();

        $posts = DB::table('posts')
        ->select(
            'posts.id',
            'posts.title',
            'posts.slug',
            'posts.cover',
            'posts.content',
            'posts.created_at AS date',
            'categories.name AS category'
        )
        ->join('categories', 'posts.category_id', 'categories.id')
        ->paginate(3);
        /* $post = Post::with(['category','tags'])->paginate(); <------ make query with model */
        
        $posts->each(function($post){
            if($post->cover){
                $post->cover = url('storage/' . $post->cover);
            }else{
                $post->cover = url('img/default-image-620x600.jpg');
            }
        });

        return response()->json($posts); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();
        if($post){/* in case the query is successfull  */
            $data = [
                'success' => true,
                'data' => $post
            ];
            return response()->json($data);
        }
        return response()->json(['succes' => false]); /* in case the query gives you nothing, ths line gives you s feedback saying that nothing is found */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
