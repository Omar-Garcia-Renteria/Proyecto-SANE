<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelDataTable extends Migration
{
    public function up()
    {
        Schema::create('excel_data', function (Blueprint $table) {
            $table->id();
            $table->string('ciclo_escolar')->nullable();
            $table->string('ef')->nullable();
            $table->string('curp')->nullable();
            $table->string('cve_plaza_inicio')->nullable();
            $table->string('tipo_plaza')->nullable();
            $table->integer('num_horas')->nullable();
            $table->string('asignatura')->nullable();
            $table->string('nivel_servicio')->nullable();
            $table->string('tipo_valoracion')->nullable();
            $table->string('tipo_examen')->nullable();
            $table->decimal('puntuacion_global', 8, 2)->nullable();
            $table->integer('posicion_ordenamiento')->nullable();
            $table->string('incentivo_atp')->nullable();
            $table->string('incentivo_pfi')->nullable();
            $table->string('incentivo_cm')->nullable();
            $table->string('incentivo_ph')->nullable();
            $table->string('nombre')->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->string('funcion')->nullable();
            $table->string('tipo_asignacion')->nullable();
            $table->string('cve_plaza_promocion')->nullable();
            $table->string('cve_categoria')->nullable();
            $table->string('cct_promocion')->nullable();
            $table->string('qna_inicio')->nullable();
            $table->string('qna_termino')->nullable();
            $table->date('caducidad_promocion')->nullable();
            $table->string('codigo_nombramiento')->nullable();
            $table->string('promocion')->nullable();
            $table->text('observaciones')->nullable();
            $table->date('fecha_alta')->nullable();
            $table->timestamps();
            $table->string('batch_id')->nullable(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('excel_data');
    }
}