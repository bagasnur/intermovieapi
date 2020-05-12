<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Film;
use App\Studio;

class FilmController extends Controller
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

      $films = Film::all();
      //$result['total_films'] = count($films);
      //$result['total_films'] = count($films);

      if ($films) {
         $data['code'] = 200;
         $data['data_found'] = count($films);
         $data['result'] = $films;
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }

   public function show($id)
   {
      $result = Film::where('id', $id)->first();
      if ($result) {
         $data['code'] = 200;
         $data['result'] = $result;
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }

   public function filterFilm(Request $request)
   {
      if ($request->search) {
         $result = Film::where('title', 'like', '%'.$request->search.'%')->orWhere('production', 'like', '%'.$request->search.'%')->orWhere('producer', 'like', '%'.$request->search.'%')->get();

         if ($result) {
            $data['code'] = 200;
            $data['data_found'] = count($result);
            $data['result'] = $result;
         } else {
            $data['code'] = 500;
            $data['status_msg'] = 'Error';
         }
      }
      if (!$request->search) {
         $data['code'] = 500;
         $data['status_msg'] = "Error Parameter Key";
      }

      return response()->json($data);
   }

   public function topFilm($total)
   {
         $result = Film::orderBy('rating', "DESC")->take($total)->get();

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
      $result = Film::create([
         'title' => $request->title,
         'story' => $request->story,
         'status' => $request->status,
         'duration' => $request->duration,
         'rating' => '0.0',
         'category' => $request->category,
         'production' => $request->production,
         'producer' => $request->producer,
         'banner' => $request->banner
      ]);

      $explode1 = explode(", ", $request->category);
      $explode2 = explode(", ", $request->production);
      $length1 = count($explode1);
      $length2 = count($explode2);
      $val1 = [];
      $val2 = [];

      for ($a = 0; $a < $length1; $a++) {
         $val1[$a] = $explode1[$a];
         Category::firstOrCreate([
            'name' => $val1[$a]
         ]);
      }

      for ($a = 0; $a < $length2; $a++) {
         $val2[$a] = $explode2[$a];
         Studio::firstOrCreate([
            'name' => $val2[$a] ,
            'url_site' => ''
         ]);
      }

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
      $result = Film::where('id', $id)->first();

      $result->title = $request->input('title');
      $result->story = $request->input('story');
      $result->status = $request->input('status');
      $result->duration = $request->input('duration');
      $result->category = $request->input('category');
      $result->production = $request->input('production');
      $result->producer = $request->input('producer');
      $result->banner = $request->input('banner');

      $explode1 = explode(", ", $request->category);
      $explode2 = explode(", ", $request->production);
      $length1 = count($explode1);
      $length2 = count($explode2);
      $val1 = [];
      $val2 = [];

      for ($a = 0; $a < $length1; $a++) {
         $val1[$a] = $explode1[$a];
         Category::firstOrCreate([
            'name' => $val1[$a]
         ]);
      }

      for ($a = 0; $a < $length2; $a++) {
         $val2[$a] = $explode2[$a];
         Studio::firstOrCreate([
            'name' => $val2[$a],
            'url_site' => ''
         ]);
      }

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
      $result = Film::where('id', $id)->first();
      if ($result->delete()) {
         $data['code'] = 200;
         $data['status_msg'] = "Data Film: " . $result->title . " deleted.";
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }
}
