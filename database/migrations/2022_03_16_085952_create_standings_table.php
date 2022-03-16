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
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->integer('league');
            $table->integer('season');
            $table->integer('club_id');
            $table->string('name');
            $table->string('where');
            $table->tinyInteger('rank');
            $table->smallInteger('points');
            $table->tinyInteger('played');
            $table->tinyInteger('win');
            $table->tinyInteger('draw');
            $table->tinyInteger('lose');
            $table->tinyInteger('goals_for')->unsigned();
            $table->tinyInteger('goals_against')->unsigned();
            $table->smallInteger('goals_diff');
            $table->string('last5');
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
        Schema::dropIfExists('standings');
    }
};
