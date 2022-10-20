<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;




class LikeController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
      $like = Like::all();
      return response()->json($like);
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

        $validator=Validator::make($input,[
        'author_id' => 'required|max:255',
        'likeable_type' => 'required'
      ]);
      if($validator->fails()){
        return response()->json()([
            'status'=>false,
            'message' => 'Inavlid input try again',
            'error' => $validator->errors(),

        ]);
    }
    //   $request->validate([
    //     'name' => 'required|max:255',
    //     'text' => 'required'
    //   ]);
      $newlikes= Like::create([
        'author_id' => $request->get('author_id'),
        'title' => $request->get('title'),
        'likeable_type' => $request->get('likeable_type'),
        'likeable_id' => $request->get('likeable_id'),
        'created_at' => $request->get('created_at'),
        'updated_at' => $request->get('updated_at')
      ]);

    //   $newlikes->save();

      return response()->json($newlikes);
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function show($id)
    {
      $likes = Like::findOrFail($id);
      return response()->json($likes);
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
      $likes = Like::findOrFail($id);

      $request->validate([
        'author_id' => 'required|max:255',
        'likeable_type' => 'required'
      ]);

      $likes->author_id = $request->get('author_id');
      $likes->likeable_type = $request->get('likeable_type');

      $likes->save();

      return response()->json($likes);
    }

    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {
      $likes = Like::findOrFail($id);
      $likes->delete();

      return response()->json($likes::all());
    }
  }
