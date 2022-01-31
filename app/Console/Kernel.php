<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CoinsUpdate::class,    // コインテーブル更新
        Commands\PricesUpdate::class,   // 価格テーブル更新
        Commands\PricesDelete::class,   // 価格テーブル削除
        Commands\BitcoinUpdate::class,  // ビットコイン更新（Heroku動作確認用）
        Commands\PricesMail::class,     // 価格メール配信
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        
        // 毎分コインテーブルを更新
        $schedule->command('command:coins-update')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
