<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTablel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->bigIncrements('id');                    // id
            $table->string('gecko_id');                     // CoinGeckoの通貨id
            $table->string('name');                         // 通貨名
            $table->string('image', 2048);                  // サムネイルURL
            $table->double('current_price');                // 現在価格
            $table->bigInteger('market_cap');               // 市場価格
            $table->integer('market_cap_rank');             // 市場価格ランク
            $table->double('price_change_percentage_24h');  // 価格変動率(24h)
            $table->double('high_24h');                     // 24h最高値
            $table->double('low_24h');                      // 24h最安値
            $table->double('ath');                          // 過去最高値
            $table->double('atl');                          // 過去最低値
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
