<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triggers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('pair_id');
            $table->unsignedInteger('event_type_id');
            $table->unsignedInteger('level');
            $table->boolean('email_sent')->default(false);
            $table->timestamps();

            // cant add the same event for the same pair for the same user twice
            // or should it?
            $table->unique(['user_id', 'pair_id', 'event_type_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('triggers');
    }
}
