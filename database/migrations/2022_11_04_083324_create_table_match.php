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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_a_id');
            $table->unsignedBigInteger('team_b_id');
            $table->unsignedBigInteger('league_id');

            $table->foreign('team_a_id')->references('id')->on('teams');
            $table->foreign('team_b_id')->references('id')->on('teams');
            $table->foreign('league_id')->references('id')->on('leagues');

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
        Schema::dropIfExists('matches');
    }
};
