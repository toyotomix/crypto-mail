<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Coin;
use App\Commons\Api\CoinGecko;

class CoinsController extends Controller
{
    public function index()
    {
        //$coins = Coin::orderBy('market_cap', 'desc')->take(1000)->paginate(100);
        // $coins = Coin::orderBy('market_cap_rank', 'asc')->limit(1000)->paginate(100);
        
        // $coins = Coin::orderBy('market_cap_rank', 'asc')->take(1000)->get();
        // $coins = new LengthAwarePaginator($coins->all(), $coins->count(), 100);
        
        $coins = Coin::orderBy('market_cap_rank', 'asc')->take(1000)->get();
        $coins = $coins->paginate(100); // マクロを使う
        
        if (\Auth::check()) {
            // 認証済みの場合
            
            // 認証済みユーザを取得
            $user = \Auth::user();
            
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            // $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'coins' => $coins,
            ];
            
            // Welcomeビューでそれらを表示
            return view('welcome', $data);
        }
        
        // 通貨リストのみビューに渡す
        return view('welcome', ['coins' => $coins]);
    }
}