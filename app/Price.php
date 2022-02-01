<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['price', 'priced_at'];
    
    /**
     * この価格に紐づく通貨
     */
    public function coin()
    {
        return $this->belongsTo(Coin::class);
    }
    
}
