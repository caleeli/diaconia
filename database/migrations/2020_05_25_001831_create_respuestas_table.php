<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('informe_id')->nullable();
            $table->bigInteger('muestra_id')->nullable();
            $table->bigInteger('revision_id');
            $table->bigInteger('pregunta_id');
            $table->string('revision');
            $table->string('clasificacion');
            $table->string('observacion');
            $table->integer('tipo_observacion');
            $table->string('riesgo_adicional');
            $table->integer('tipo_credito');
            $table->string('calidad');
            $table->text('respuesta_jefe_agencia');
            $table->text('seguimiento');
            $table->timestamps();

            /*$table->foreign('informe_id')
                ->references('id')->on('informes')
                ->onDelete('cascade')
                ->onUpdate('restrict');*/
            $table->foreign('revision_id')
                ->references('id')->on('revisiones')
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreign('pregunta_id')
                ->references('id')->on('plantilla_preguntas')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
}
