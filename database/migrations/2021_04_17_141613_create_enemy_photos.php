<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnemyPhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enemy_photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enemy_id');
            $table->string('photo');
            $table->string('position');

            $table->timestamps();

            $table->foreign('enemy_id')->references('id')->on('enemies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enemy_photos');
    }
}
