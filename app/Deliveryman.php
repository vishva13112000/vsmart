<?php

namespace App;

use App\Notifications\DeliverymanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Deliveryman extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function shop(){
        return $this->belongsTo('App/Shop','shopid','id');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DeliverymanResetPassword($token));
    }
}
