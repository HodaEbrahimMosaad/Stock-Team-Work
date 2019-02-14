<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePairsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairs_history', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('from_id');
            $table->unsignedInteger('to_id');
            $table->float('exchange_rate', 5, 3);

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
        Schema::dropIfExists('pairs_history');
    }
}
