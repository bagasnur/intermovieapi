<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
   protected $primaryKey = 'id';
   protected $table = 'films';
   protected $fillable = [
      'title', 'story', 'status', 'duration', 'rating', 'category', 'production', 'producer', 'banner', 
   ];
   public $timestamps = true;
}