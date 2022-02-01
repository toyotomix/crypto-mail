<?php

namespace App\Console\Commands;

use App\Price;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PricesDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:prices-delete';

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
        // コンソール出力用
        $count = 0;
        // 価格データ取得
        $prices = Price::all();
        foreach ($prices as $price) {
            try {
                $now = Carbon::now();
                $yesterday = clone $now;
                $yesterday->subHours(24);
                $time = Carbon::parse($price->priced_at);
                
                // 24時間経過したデータを削除する
                if ($time->lte($yesterday)) {
                    Price::destroy($price->id);
                    $count++;
                }
                
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        // コンソール出力
        echo '[prices-delete] Succesfull deleted ' . $count . ' price data' . PHP_EOL;
    }
}
