<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class MediaController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
      $medias = Media::all();
      return response()->json($medias);
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
        'disk' => 'required'
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
      $newmedias = Media::create([
        'model_type'=> $request->get('model_type'),
        'model_id' => $request->get('model_id'),
        'file_name' => $request->get('file_name'),
        'mime_type' => $request->get('mime_type'),
        'disk' => $request->get('disk'),
        'size' => $request->get('size'),
        'manipulations' => $request->get('manipulations'),
        'custom_properties' => $request->get('custom_properties'),
        'responsive_images' => $request->get('responsive_images'),
        'posted_at' => $request->get('posted_at'),
        'order_column' => $request->get('order_column'),
        'updated_at' => $request->get('updated_at'),
        'onversions_disk' => $request->get('onversions_disk')
      ]);

    //   $newmedias->save();

      return response()->json($newmedias);
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function show($id)
    {
      $media = Media::findOrFail($id);
      return response()->json($media);
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
      $media = Media::findOrFail($id);

      $request->validate([
        'name' => 'required|max:255',
        'disk' => 'required'
      ]);

      $media->name = $request->get('name');
      $media->disk = $request->get('disk');

      $media->save();

      return response()->json($media);
    }

    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
    public function destroy($id)
    {
      $media = Media::findOrFail($id);
      $media->delete();

      return response()->json($media::all());
    }
  }
