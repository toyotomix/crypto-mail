<?php

namespace App\Http\Controllers;

use App\Coin;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CoinsController extends Controller
{
    /**
     * トップページを表示する
     * 
     * @return view
     */
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
    
    /**
     * 通貨詳細を表示する
     * 
     * @param $gecko_id CoinGeckoの通貨id
     * @return view
     */
    public function show($gecko_id)
    {
        // gecko_idが一致する通貨を取得
        $coin = Coin::where('gecko_id', '=', $gecko_id)->first();
        
        // 通貨に紐づく24時間以内の価格を取得
        $prices = $coin
            ->prices()
            ->orderBy('priced_at','asc')
            // ->whereRaw('priced_at > NOW() - INTERVAL 1 DAY')     // Herokuでエラー出る
            ->get();
        
        // チャートデータ
        $chart = [
            'labels' => [],
            'data' => []
        ];
        
        foreach ($prices as $price) {
            $now = Carbon::now();
            $yesterday = Carbon::yesterday();
            $time = Carbon::parse($price->priced_at);
            
            // 24時間以内のデータのみチャートに表示
            if ($time->between($yesterday, $now)) {
                array_push($chart['labels'], $price->priced_at);
                array_push($chart['data'], $price->price);
            }
        }
        
        return view('coins.show', ['coin' => $coin, 'chartData' => $chart]);
    }
}