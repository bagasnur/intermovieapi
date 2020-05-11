<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Season;

class SeasonController extends Controller
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

      $ssn = Season::all();
      //$result['total_films'] = count($films);
      //$result['total_films'] = count($films);

      if ($ssn) {
         $data['code'] = 200;
         $data['result'] = $ssn;
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }

   public function store(Request $request)
   {
      $result = Season::create([
         'film_id' => $request->film_id,
         'season' => $request->season,
         'year' => $request->year
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
      $result = Season::where('id', $id)->first();

      $result->film_id = $request->input('film_id');
      $result->season = $request->input('season');
      $result->year = $request->input('year');
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
      $result = Season::where('id', $id)->first();
      if ($result->delete()) {
         $data['code'] = 200;
         $data['status_msg'] = "Data Season: " . $result->season . " " . $result->year . ", ID Film: " . $result->film_id . " deleted.";
      } else {
         $data['code'] = 500;
         $data['status_msg'] = 'Error';
      }
      return response()->json($data);
   }
}
