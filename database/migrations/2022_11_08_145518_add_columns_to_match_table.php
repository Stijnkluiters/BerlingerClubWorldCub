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
        Schema::table('matches', function (Blueprint $table) {
            $table->integer('team_a_score')
                ->default(null)
                ->nullable();
            $table->integer('team_b_score')
                ->default(null)
                ->nullable();
            $table
                ->unsignedBigInteger('winning_team_id')
                ->default(null)
                ->nullable();

            $table->foreign('winning_team_id')
                ->references('id')
                ->on('matches')
            ;

            $table->integer('highest_score')
                ->nullable()
                ->default(null)
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function (Blueprint $table) {
            //
        });
    }
};
