<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scorers', function (Blueprint $table) {
            $table->id();
            $table->integer('league');
            $table->integer('season');
            $table->integer('club_id');
            $table->integer('player_id');
            $table->tinyInteger('total');
            $table->tinyInteger('home');
            $table->tinyInteger('away');
            $table->string('photo');
            $table->string('first_name');
            $table->string('last_name');
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
        Schema::dropIfExists('scorers');
    }
};
