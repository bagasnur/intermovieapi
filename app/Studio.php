<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
   protected $primaryKey = 'id';
   protected $table = 'studios';
   protected $fillable = [
      'name', 'url_site',
   ];
   public $timestamps = false;

}
