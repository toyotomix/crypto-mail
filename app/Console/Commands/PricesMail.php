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
            // ユーザが通知対象にしている通貨を取得
            $coins = $user->alert_coins()->orderBy('market_cap_rank', 'asc')->get();
            if (count((Array) $coins) == 0) {
                continue;
            }
            
            // メール送信
            \Mail::to($user->email)->send(new CurrentPrices($coins));
            echo '[prices-mail] sended to ' . $user->email . PHP_EOL;
        }
    }
}
