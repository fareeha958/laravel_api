<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class SubscriptionController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
      $subscriptions = Subscription::all();
      return response()->json($subscriptions);
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
                return response()->json([
                    'status'=>false,
                    'message' => 'Inavlid input try again',
                    'error' => $validator->errors(),

                ]);
            }
    //   $request->validate([
    //     'name' => 'required|max:255',
    //     'text' => 'required'
    //   ]);
      $newSubscriptions = Subscription::create([
        'user_id' => $request->get('user_id'),
        'subscriptionable_id' => $request->get('subscriptionable_id')
      ]);

    //   $newSubscriptions->save();
      return response()->json($newSubscriptions);
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function show($id)
    {
      $subscription = Subscription::findOrFail($id);
      return response()->json($subscription);
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
      $subscription = Subscription::findOrFail($id);

      $request->validate([
        'user_id' => 'required|max:255',
        'subscriptionable_id' => 'required'
      ]);

      $subscription->user_id = $request->get('user_id');
      $subscription->subscriptionable_id = $request->get('subscriptionable_id');

      $subscription->save();

      return response()->json($subscription);
    }

    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {
      $subscription = Subscription::findOrFail($id);
      $subscription->delete();

      return response()->json($subscription::all());
    }
  }
