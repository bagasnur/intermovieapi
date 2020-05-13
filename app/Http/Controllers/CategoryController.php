<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Category;
use App\Film;

class CategoryController extends Controller
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

      $cat = Category::all();
      //$result['total_films'] = count($films);
      //$result['total_films'] = count($films);

      if ($cat) {
         $data['code'] = 200;
         $data['result'] = $cat;
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }

   public function show($id)
   {
      $result = Category::where('id', $id)->first();
      if ($result) {
         $data['code'] = 200;
         $data['result'] = $result;
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }

   public function filterCategory(Request $request)
   {
      if($request->category){
         $result = Film::where('category', 'like', '%' . $request->category . '%')->get();

         if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
         } else {
            $data['code'] = 500;
            $data['status_msg'] = 'Error';
         }
      }
      if(!$request->category){
         $data['code'] = 500;
         $data['status_msg'] = "Error Parameter Key";
      }

      return response()->json($data);
   }

   public function topCategory()
   {
         $result = Category::orderBy('name', "ASC")->get();

         if ($result) {
            $data['code'] = 200;
            $data['data_found'] = count($result);
            $data['result'] = $result;
         } else {
            $data['code'] = 500;
            $data['status_msg'] = 'Error';
         }

      return response()->json($data);
   }

   public function store(Request $request)
   {
      $result = Category::create([
         'name' => $request->category,
         'verified' => $request->verified
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
      $result = Category::where('id', $id)->first();

      $result->name = $request->input('category');
      $result->verified = $request->input('verified');
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
      $result = Category::where('id', $id)->first();
      if ($result->delete()) {
         $data['code'] = 200;
         $data['status_msg'] = "Data Film: " . $result->name . " deleted.";
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }
}
