<?php

use App\Models\Club;
use App\Models\Head2head;
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
        Schema::create('club_h2h', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Club::class);
            $table->foreignIdFor(Head2head::class);
            $table->string('location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_h2h');
    }
};
