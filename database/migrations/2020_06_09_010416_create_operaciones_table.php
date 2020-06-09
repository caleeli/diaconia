<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones', function (Blueprint $table) {
            $table->id();
            $table->string('prmprnpre',16);// CHARACTER SET latin1 NOT NULL,
            $table->string('gbagenomb',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprtcre',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prtcrdesc',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprfdes',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprmdes',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprsald',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprcmon',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('moneda',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprstat',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('estado',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprplzo',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprplaz',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('plaza',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmpragen',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('agencia',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprautp',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('autoriza',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('prmprrseg',128);// CHARACTER SET latin1 NOT NULL,
            $table->string('asesor',128);// CHARACTER SET latin1 NOT NULL,
            $table->integer('ncreditos')->nullable();// DEFAULT NULL,
            $table->string('tasa',11)->nullable();// CHARACTER SET latin1 DEFAULT NULL,
            $table->string('gbagedir1',200)->nullable();// CHARACTER SET latin1 DEFAULT NULL,
            $table->string('cargosdesem',2048)->nullable();// CHARACTER SET latin1 DEFAULT NULL,
            $table->string('cargosadmin',2048)->nullable();// CHARACTER SET latin1 DEFAULT NULL,
            $table->string('prmprfpvc',50)->nullable();// CHARACTER SET latin1 DEFAULT NULL COMMENT 'fecha vencimiento',
            $table->integer('mora')->nullable();// DEFAULT NULL COMMENT 'dias de mora',
            $table->integer('gbagecage')->nullable();// DEFAULT NULL COMMENT 'nro cliente',
            $table->string('ini_plan_pago',32)->nullable();// CHARACTER SET latin1 DEFAULT NULL,
            $table->string('garantia',1024)->nullable();// CHARACTER SET latin1 DEFAULT NULL,
            $table->string('gbciidesc',1024)->nullable();// CHARACTER SET latin1 DEFAULT NULL,
            $table->string('ult_pago',32)->nullable();// CHARACTER SET latin1 DEFAULT NULL,
            $table->string('prox_pago',32)->nullable();// COLLATE utf8_spanish_ci DEFAULT NULL,
            $table->string('fec_incumplimiento',32)->nullable();// COLLATE utf8_spanish_ci DEFAULT NULL,
            $table->string('fec_cierre',32)->nullable();// COLLATE utf8_spanish_ci DEFAULT NULL,
            $table->integer('num_cuotas')->nullable();// DEFAULT NULL,
            $table->string('tipo_plazo',64)->nullable();// COLLATE utf8_spanish_ci DEFAULT NULL,
            $table->string('con_mora',11)->nullable();// COLLATE utf8_spanish_ci DEFAULT NULL,
            $table->string('gasto',128)->nullable();// COLLATE utf8_spanish_ci DEFAULT NULL,
            $table->integer('acbccccic')->nullable();// DEFAULT NULL,
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
        Schema::dropIfExists('operaciones');
    }
}
