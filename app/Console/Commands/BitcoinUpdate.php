<?php

namespace App\Console\Commands;

use App\Coin;
use App\Lib\Api\CoinGecko;
use Illuminate\Console\Command;

class BitcoinUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:bitcoin-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Bitcoinのマーケット情報を取得
        $datas = CoinGecko::fetchMarkets(1, 1);
        
        foreach($datas as $data) {
            $coin = new Coin();
            $exist = $coin->where('gecko_id', $data['id'])->exists();
                    
            if($exist) {
                // 既存は更新
                $coin->where('gecko_id', $data['id'])
                    ->update([
                        'name' => $data['name'],
                        'image' => $data['image'],
                        'current_price' => (float) $data['current_price'],
                        'market_cap' => (int) $data['market_cap'],
                        'market_cap_rank' => (int) $data['market_cap_rank'],
                        'price_change_percentage_24h' => (float) $data['price_change_percentage_24h'],
                        'high_24h' => (float) $data['high_24h'],
                        'low_24h' => (float) $data['low_24h'],
                        'ath' => (float) $data['ath'],
                        'atl' => (float) $data['atl'],
                    ]);
                // コンソール出力
                echo '[coins-update] Succesfull update of '. '"' . $data['id'] . '"' . PHP_EOL;
                continue;
            }
                    
            // 新規
            $coin->gecko_id = $data['id'];
            $coin->name = $data['name'];
            $coin->image = $data['image'];
            $coin->current_price = (float) $data['current_price'];
            $coin->market_cap = (int) $data['market_cap'];
            $coin->market_cap_rank = (int) $data['market_cap_rank'];
            $coin->price_change_percentage_24h = (float) $data['price_change_percentage_24h'];
            $coin->high_24h = (float) $data['high_24h'];
            $coin->low_24h = (float) $data['low_24h'];
            $coin->ath = (float) $data['ath'];
            $coin->atl = (float) $data['atl'];
                    
            if($coin->save()) {
                // コンソール出力
                echo '[coins-update] Succesfull save of ' . '"' . $data['id'] . '"' . PHP_EOL;
            }
        }
    }
}
