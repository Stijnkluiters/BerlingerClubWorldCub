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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('match_id');

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('match_id')->references('id')->on('matches');

            $table->string('goal_type')->default('conceded');

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
        Schema::dropIfExists('goals');
    }
};
