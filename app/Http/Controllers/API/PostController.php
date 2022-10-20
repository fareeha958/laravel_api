<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



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
    return response()->json($posts);
  }

  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request)
  {
    $input=$request->all();

    $validator=validator::make($input,[
    'title' => 'required|max:255',
    'slug' => 'required'
  ]);
  if($validator->fails()){
    return response()->json()([
        'status'=>false,
        'message' => 'Inavlid input try again',
        'error' => $validator->errors(),

    ]);
  }
    // $request->validate([
    //   'name' => 'required|max:255',
    //   'text' => 'required'
    // ]);
    $newPosts = Post::create([
      'author_id' => $request->get('author_id'),
      'title' => $request->get('title'),
      'slug' => $request->get('slug'),
      'posted_at' => $request->get('posted_at'),
      'created_at' => $request->get('created_at'),
      'updated_at' => $request->get('updated_at')
    ]);

    // $newPosts->save();

    return response()->json($newPosts);
  }

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show($id)
  {
    $posts = Post::findOrFail($id);
    return response()->json($posts);
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
    $post = Post::findOrFail($id);

    $request->validate([
      'title' => 'required|max:255',
      'slug' => 'required'
    ]);

    $post->title = $request->get('title');
    $post->slug = $request->get('slug');

    $post->save();

    return response()->json($post);
  }

  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    $post->delete();

    return response()->json($post::all());
  }
}

