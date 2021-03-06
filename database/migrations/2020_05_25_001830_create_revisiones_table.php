<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisiones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('informe_id')->nullable();
            $table->bigInteger('carpeta_id')->nullable();
            $table->bigInteger('plantilla_id');
            $table->bigInteger('revisor_id');
            $table->bigInteger('elaborador_id');
            $table->string('calidad')->default('PRELIMINAR');
            $table->string('sucursal');
            $table->string('tipo_inf');
            $table->string('visita');
            $table->date('fecha_muestra');
            $table->date('fecha_revision')->nullable();
            $table->date('fecha_visita')->nullable();
            $table->string('lugar_visita')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();

            /*$table->foreign('informe_id')
                ->references('id')->on('informes')
                ->onDelete('cascade')
                ->onUpdate('restrict');*/
            $table->foreign('plantilla_id')
                ->references('id')->on('plantillas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('revisor_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('elaborador_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('revisiones');
    }
}
