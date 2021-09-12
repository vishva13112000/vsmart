<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
      protected $guarded=['id'];


      public function brand(){
        return $this->belongsTo('App\Models\Brands','brand_id','id');
       }
      public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
      }
       public function shop(){
        return $this->belongsTo('App\Shop','shop_id','id');
      }



}


