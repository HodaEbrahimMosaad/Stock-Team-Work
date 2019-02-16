<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('from_id');
            $table->unsignedInteger('to_id');
            $table->unsignedInteger('duration');
            $table->float('exchange_rate', 5, 3)->default(0);
            $table->softDeletes();
            $table->timestamps();

            // cant add the same pair for the same user twice
            $table->unique(['user_id', 'from_id', 'to_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pairs');
    }
}
