<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantillaPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantilla_preguntas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('plantilla_id');
            $table->string('grupo');
            $table->string('indice')->nullable();
            $table->string('descripcion');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('plantilla_id')
                ->references('id')->on('plantillas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantilla_preguntas');
    }
}
