<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
   protected $primaryKey = 'id';
   protected $table = 'seasons';
   protected $fillable = [
      'film_id', 'season', 'year',
   ];
   public $timestamps = false;

}
