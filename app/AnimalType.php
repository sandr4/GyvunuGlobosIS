<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalType extends Model
{
    //
     public function room_type()
    {
        return $this->belongsTo('App\Animal', 'room_type_fk', 'id');
    }
}
