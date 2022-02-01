<?php

namespace App\Console\Commands;

use App\Coin;
use App\Mail\CurrentPrices;
use App\User;
use Illuminate\Console\Command;

class PricesMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:prices-mail';

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
        // ユーザ情報取得
        $users = User::all();
        if (count($users) == 0) {
            echo '[prices-mail] no users data.' . PHP_EOL;
            return;
        }
        
        foreach ($users as $user) {
            // ユーザに紐づく通知を取得
            $alert_coins = $user->alert_coins();
            if (count((Array) $alert_coins) == 0) {
                // 通知情報なし
                continue;
            }
            foreach ($alert_coins as $alert_coin) {
                // 通貨情報を取得
                $coin = Coin::find($alert_coin);
                // メール送信
                \Mail::to('tytmixx@gmail.com')->send(new CurrentPrices($coin->name, $coin->current_price));
                echo '[prices-mail] sended to ' . $user->email . ', ' . $coin->name . ' price' . PHP_EOL;
            }
        }
    }
}
