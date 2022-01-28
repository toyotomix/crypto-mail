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
    
    /**
     * この価格に関係するモデルの数をロードする
     * 
     * アクションでこのメソッドを$coin->loadRelationshipCounts()のように呼び出し、
     * ビューで$coin->prices_countのように件数を取得する
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount('prices');
    }
}
