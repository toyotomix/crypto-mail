<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    /**
     * この通知に紐づくユーザ
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    /**
     * この通知に紐づく通貨
     */
    public function coin() {
        return $this->belongsTo(Coin::class);
    }
}
