<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //
    public function room_type()
    {
        return $this->hasOne('App\AnimalType', 'id','animal_type_fk');
    }
     public function photo()
    {
        return $this->hasOne('App\Photo', 'id', 'photo_fk');
    }
    public function rate()
    {
        return $this->hasMany('App\Rate');
    }
        public function amenities()
    {
        return $this->hasMany('App\Amenities');
    }

}
