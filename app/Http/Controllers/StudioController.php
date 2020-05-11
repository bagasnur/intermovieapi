<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Studio;

class StudioController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      //
   }

   public function index()
   {

      $studio = Studio::all();
      //$result['total_films'] = count($films);
      //$result['total_films'] = count($films);

      if ($studio) {
         $data['code'] = 200;
         $data['result'] = $studio;
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }

   public function show($id)
   {
      $result = Studio::where('id', $id)->first();
      if ($result) {
         $data['code'] = 200;
         $data['result'] = $result;
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }

   public function store(Request $request)
   {
      $result = Studio::create([
         'name' => $request->name,
         'url_site' => $request->url
      ]);

      if ($result) {
         $data['code'] = 200;
         $data['status_msg'] = "Data Recorded";
         $data['result'] = $result;
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response($result);
   }

   public function update(Request $request, $id)
   {
      $result = Studio::where('id', $id)->first();

      $result->name = $request->input('name');
      $result->url_site = $request->input('url');
      $result->save();

      if ($result) {
         $data['code'] = 200;
         $data['status_msg'] = "Data Updated";
         $data['result'] = $result;
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }

   public function destroy($id)
   {
      $result = Studio::where('id', $id)->first();
      if ($result->delete()) {
         $data['code'] = 200;
         $data['status_msg'] = "Data Production Studio: " . $result->name . " deleted.";
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }
}
