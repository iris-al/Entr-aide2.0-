<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('ads_id')->unsigned();
            $table->double('rating');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ads_id')->references('id')->on('ads')->onDelete('cascade');
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
        Schema::dropIfExists('ratings');
    }
}
