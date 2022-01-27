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
     * この通貨をアラート対象にしているユーザ
     */
    public function alerts_users()
    {
        return $this->belongsToMany(Coin::class, 'alerts', 'coin_id', 'user_id')->withTimestamps();
    }
}
