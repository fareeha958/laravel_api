<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
      $users = User::all();
      return response()->json($users);
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
        'name' => 'required|max:255',
        'email' => 'required',
        'password' => 'required'
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
      $newUser = User::create([
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'password'=> Hash::make($request->get('password')),
      ]);

    //   $newUser->save();

      return response()->json($newUser);
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function show($id)
    {
      $user = User::findOrFail($id);
      return response()->json($user);
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
      $user = User::findOrFail($id);

      $request->validate([
        'name' => 'required|max:255',
        'email' => 'required'
      ]);

      $user->name = $request->get('name');
      $user->email = $request->get('email');

      $user->save();

      return response()->json($user);
    }

    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {
      $user = User::findOrFail($id);
      $user->delete();

      return response()->json($user::all());
    }
  }
