<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * このユーザの通知情報
     */
    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
    
    /**
     * このユーザが通知対象にしている通貨
     */
    public function alert_coins()
    {
        return $this->belongsToMany(Coin::class, 'alerts', 'user_id', 'coin_id')->withTimestamps();
    }
    
    /**
     * アラート登録する
     * 
     * @param $coinId 通貨id
     * @return bool
     */
    public function alert($coinId)
    {
        // すでにアラート登録済みか
        $exist = $this->is_alerts($coinId);

        if($exist) {
            // アラート登録済み
            return false;
        }
        
        // アラート登録
        $this->alert_coins()->attach($coinId);
        return true;
    }
    
    /**
     * アラート解除する
     * 
     * @param $coinId 通貨id
     * @return bool
     */
    public function unalert($coinId)
    {
        // すでにアラート登録済みか
        $exist = $this->is_alerts($coinId);
        
        if (!$exist) {
            // 存在しない
            return false;
        }
        
        // アラート解除
        $this->alert_coins()->detach($coinId);
        return true;
    }
    
    /**
     * 指定の通貨が既にアラート登録済みか調べる
     * 
     * @param int $coinId
     * @return bool 登録済：true 未登録：false
     */ 
    public function is_alerts($coinId)
    {
        return $this->alert_coins()->where('coin_id', $coinId)->exists();
    }
}
