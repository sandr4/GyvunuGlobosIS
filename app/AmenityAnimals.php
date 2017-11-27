<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmenityAnimals extends Model
{
    //
    public function amenities()
    {
    	return $this->belongsTo('App\Amenities');
    }
    public function room()
    {
    	return $this->belongsTo('App\Animal');
    }

}
