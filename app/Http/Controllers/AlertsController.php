<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Coin;
use App\Commons\Api\CoinGecko;

class AlertsController extends Controller
{
    public function index()
    {
        // 認証済みユーザを取得
        $user = \Auth::user();
        // ユーザがアラート登録している通貨を取得
        $coins = $user->alert_coins()->get();
        // ページネーション（マクロを使う）
        $coins = $coins->paginate(100);
        // 通貨リストのみビューに渡す
        return view('welcome', ['coins' => $coins]);
    }
    
    public function store()
    {
        
    }
    
    public function destroy()
    {
        
    }
}
