<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Replay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplayController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
      $replays = Replay::all();
      return response()->json($replays);
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
        'body' => 'required|max:255',
        'replayble_id' => 'required'
      ]);
      if($validator->fails()){
        return response()->json()([
            'status'=>false,
            'message' => 'Inavlid input try again',
            'error' => $validator->errors(),

        ]);
      }
      $newReplays = Replay::create([
        'body' => $request->get('body'),
        'author_id' => $request->get('author_id'),
        'replayble_id' => $request->get('replayble_id'),
        'posted_at' => $request->get('posted_at'),
        'created_at' => $request->get('created_at'),
        'updated_at' => $request->get('updated_at')

      ]);

    //   $newReplays->save();

      return response()->json($newReplays);
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function show($id)
    {
      $replay = Replay::findOrFail($id);
      return response()->json($replay);
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
      $replay = Replay::findOrFail($id);

      $request->validate([
        'body' => 'required|max:255',
        'replayble_id' => 'required'
      ]);

      $replay->body = $request->get('body');
      $replay->replayble_id = $request->get('replayble_id');

      $replay->save();

      return response()->json($replay);
    }

    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {
      $replay = Replay::findOrFail($id);
      $replay->delete();

      return response()->json($replay::all());
    }
  }
