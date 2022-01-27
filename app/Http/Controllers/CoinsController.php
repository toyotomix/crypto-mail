<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Commons\Api\CoinGecko;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CoinsController extends Controller
{
    // index
    public function index()
    {
        // 時価総額ランクの上位1000件を取得
        $coins = Coin::orderBy('market_cap_rank', 'asc')->take(1000)->get();
        // ページネーション（マクロを使う）
        $coins = $coins->paginate(100);
        
        // 認証済み
        if (\Auth::check()) {
            // 認証済みユーザを取得
            $user = \Auth::user();
            // Welcomeビューでそれらを表示
            return view('index', ['user' => $user, 'coins' => $coins]);
        }
        
        // 通貨リストのみビューに渡す
        return view('index', ['coins' => $coins]);
    }
    
    // show
    public function show($gecko_id)
    {
        // 通貨情報を取得
        $coin = Coin::where('gecko_id', '=', $gecko_id)->first();
        
        // 'created_at'が24時間以内のデータに絞り込む
        $prices = $coin
            ->prices()
            ->orderBy('created_at','desc')
            ->whereRaw('created_at > NOW() - INTERVAL 1 DAY')
            ->get();
            
        return view('coins.show', ['coin' => $coin, 'prices' => $prices]);
    }
}