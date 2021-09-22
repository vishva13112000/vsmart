<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deliveryman extends Model
{
    use SoftDeletes;

     protected $guarded=['id'];

        public function shop(){
        return $this->belongsTo('App\Shop','shopid','id');
      }
}
