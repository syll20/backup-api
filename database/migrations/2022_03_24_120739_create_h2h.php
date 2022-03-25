<?php

use App\Models\Competition;
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
        Schema::create('h2h', function (Blueprint $table) {
            $table->id();
            $table->dateTime('played_at');
            //$table->string('teams');
            $table->tinyInteger('home_goals');
            $table->tinyInteger('away_goals');
            //$table-> 
            $table->foreignIdFor(Competition::class);
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
        Schema::dropIfExists('table_h2h');
    }
};
