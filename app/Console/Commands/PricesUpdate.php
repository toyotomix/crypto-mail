<?php

namespace App\Console\Commands;

use App\Coin;
use App\Lib\Api\CoinGecko;
use DateTime;
use DateTimeZone;
use Illuminate\Console\Command;

class PricesUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:prices-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Coins Table Update';

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
        // ループカウンタ
        $count = 1;
        
        while(true) {
            try{
                // マーケット情報を250件取得
                $datas = CoinGecko::fetchMarkets(250, $count);

                foreach($datas as $data) {
                    // コインテーブルに一致する'gecko_id'がある場合に価格テーブルを作成する
                    $coin = Coin::where('gecko_id', '=', $data['id'])->first();
                    if($coin == null) {
                        continue;
                    }
                    
                    // 価格時点の日時をJSTに変換
                    $priced_at = new DateTime($data['last_updated']);
                    $jst = $priced_at->setTimeZone(new DateTimeZone('Asia/Tokyo'))->format('Y-m-d H:i:s');
                    
                    // 価格レコード作成
                    $coin->prices()->create([
                        'price' => (float) $data['current_price'],
                        'priced_at' => $jst,
                    ]);
                    // コンソール出力
                    echo '[prices-update] Succesfull save of ' . '"' . $data['id'] . '"' . ' price' . PHP_EOL;
                }
                
                if($count == 5) {
                    // 1250件(250 x 5)で終了
                    break;
                }
                
                // インクリメント
                $count++;
                
            } catch (Exception $e) {
                echo $e->getMessage();
                break;
            }
        }
    }
}
