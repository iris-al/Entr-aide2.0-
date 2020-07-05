<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->BigIncrements('id');// pour que l'id de ad puisse être reconnu comme clé étrangère dans la table Comments
            $table->string('title');
            $table->text('description');
            $table->string('localisation');
            $table->string('categorie');
            $table->string('count');
            $table->bigInteger('nbr_vue'); // pour enregistrer le nombre de vue
            $table->bigInteger('user_id')->unsigned(); //il faut le mettre en BigInteger pour que la clé étrangère ce crée
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('filename');
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
        Schema::dropIfExists('ads');
    }
}
