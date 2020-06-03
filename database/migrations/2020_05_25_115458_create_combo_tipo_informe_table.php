<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComboTipoInformeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_tipo_informe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('valor', 32);
            $table->string('descripcion');
            $table->unique('valor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combo_tipo_informe');
    }
}
