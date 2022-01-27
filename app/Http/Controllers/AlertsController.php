<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Commons\Api\CoinGecko;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AlertsController extends Controller
{
    public function index()
    {
        // 認証済みユーザを取得
        $user = \Auth::user();
        // ユーザがアラート登録している通貨を取得
        $coins = $user->alert_coins()->orderBy('market_cap_rank', 'asc')->get();
        // ページネーション（マクロを使う）
        $coins = $coins->paginate(100);
        // 通貨リストのみビューに渡す
        return view('index', ['coins' => $coins]);
    }
    
    /**
     * アラートを登録するアクション。
     *
     * @param  $coinId 通貨id
     * @return \Illuminate\Http\Response
     */
    public function store($coinId)
    {
        \Auth::user()->alert($coinId);
        return back();
    }
    
    /**
     * アラートを解除するアクション。
     *
     * @param  $coinId 通貨id
     * @return \Illuminate\Http\Response
     */
    public function destroy($coinId)
    {
        \Auth::user()->unalert($coinId);
        return back();
    }
}
