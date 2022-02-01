<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    /**
     * このコインに紐づく価格
     */
     public function prices()
     {
         return $this->hasMany(Price::class);
     }
     
     /**
      * この通貨が対象となっている通知
      */
     public function alerts()
     {
         return $this->hasMany(Alert::class);
     }
     
     /**
     * この通貨を通知対象にしているユーザ
     */
    public function alert_users()
    {
        return $this->belongsToMany(User::class, 'alerts', 'coin_id', 'user_id')->withTimestamps();
    }
}
