<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatedAnimals extends Model
{
     public function rate()
    {
    	return $this->belongsTo('App\Rate');
    }
     public function room()
    {
    	return $this->belongsTo('App\Animal');
    }
}
