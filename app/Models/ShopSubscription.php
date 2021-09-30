<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopSubscription extends Model
{
    protected $guarded=['id'];
    public function subscription(){
        return $this->belongsTo('App\Models\Subscriptions','subscription_id','id');
    }
    public function shop(){
        return $this->belongsTo('App\Shop','shop_id','id');
    }
}
