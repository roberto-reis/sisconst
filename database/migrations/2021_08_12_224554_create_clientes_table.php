<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('contrato');
            $table->string('rasao_social');
            $table->string('cnpj');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->char('uf', 2);
            $table->integer('inscricao_municipal')->nullable();
            $table->integer('inscricao_estadual')->nullable();
            $table->char('classe_servico', 1)->nullable();
            $table->decimal('valor_urs', 8, 2)->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
