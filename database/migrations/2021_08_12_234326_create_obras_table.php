<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_projeto');
            $table->foreignId('id_supervisor')->nullable();
            $table->foreignId('id_empreiteiro')->nullable();
            $table->foreignId('id_status_obra');
            $table->foreignId('id_usuario');
            $table->date('inicio_real')->nullable();
            $table->date('termino_real')->nullable();
            $table->char('fotos_anexo_xiii', 1)->default('N');
            $table->date('data_fotos_anexo_xiii')->nullable();
            $table->char('fotos_emergencia', 1)->default('N');
            $table->date('data_fotos_emergencia')->nullable();
            $table->string('fiscal_cliente')->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();

            $table->foreign('id_projeto')->references('id')->on('projetos');
            $table->foreign('id_supervisor')->references('id')->on('supervisores');
            $table->foreign('id_empreiteiro')->references('id')->on('empreiteiros');
            $table->foreign('id_status_obra')->references('id')->on('status_obras');
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras');
    }
}
