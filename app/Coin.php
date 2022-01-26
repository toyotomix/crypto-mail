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
}
