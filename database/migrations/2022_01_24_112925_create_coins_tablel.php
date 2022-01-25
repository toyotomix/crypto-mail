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
            $table->bigIncrements('id');
            $table->string('gecko_id');
            $table->string('name');
            $table->string('image', 2048);
            $table->double('current_price');
            $table->bigInteger('market_cap');
            $table->integer('market_cap_rank');
            $table->double('price_change_percentage_24h');
            $table->double('high_24h');
            $table->double('low_24h');
            $table->double('ath');
            $table->double('atl');
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
