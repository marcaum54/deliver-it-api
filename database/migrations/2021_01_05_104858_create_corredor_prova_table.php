<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorredorProvaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corredor_prova', function (Blueprint $table) {
            $table->id();

            $table->unique(['corredor_id', 'prova_id']);

            $table->bigInteger('corredor_id')->unsigned();
            $table->foreign('corredor_id')
                ->references('id')
                ->on('corredores');

            $table->bigInteger('prova_id')->unsigned();
            $table->foreign('prova_id')
                ->references('id')
                ->on('provas');

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
        Schema::dropIfExists('corredor_prova');
    }
}
