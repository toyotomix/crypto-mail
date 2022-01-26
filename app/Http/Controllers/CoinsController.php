<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Coin;
use App\Commons\Api\CoinGecko;

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
            return view('welcome', ['user' => $user, 'coins' => $coins]);
        }
        
        // 通貨リストのみビューに渡す
        return view('welcome', ['coins' => $coins]);
    }
    
    // show
    public function show($gecko_id)
    {
        $coin = Coin::where('gecko_id', '=', $gecko_id)->first();
        return view('coins.show', ['coin' => $coin]);
    }
}