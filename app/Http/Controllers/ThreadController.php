<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ThreadController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
      $threads = Thread::all();
      return response()->json($threads);
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
        'author_id' => 'required|numeric',
        'subject' => 'required|max:255',
        'body' => 'required',
        'replay_id' => 'required|numeric'
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
      $newthreads = Thread::create([
        'author_id' => $request->get('author_id'),
        'subject' => $request->get('subject'),
        'body' => $request->get('body'),
        'replay_id' => $request->get('replay_id')
      ]);

    //   $newthreads->save();

      return response()->json($newthreads);
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function show($id)
    {
      $thread = Thread::findOrFail($id);
      return response()->json($thread);
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
      $thread = Thread::findOrFail($id);

      $request->validate([
        'subject' => 'required|max:255',
        'body' => 'required'
      ]);

      $thread->subject = $request->get('subject');
      $thread->body = $request->get('body');

      $thread->save();

      return response()->json($thread);
    }

    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {
      $thread = Thread::findOrFail($id);
      $thread->delete();

      return response()->json($thread::all());
    }
  }
