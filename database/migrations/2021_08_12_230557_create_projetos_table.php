<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_estacao');
            $table->foreignId('id_cliente');
            $table->foreignId('id_tipo_servico');
            $table->string('num_projeto');
            $table->date('data_oe')->nullable();
            $table->string('numero_oe_oc')->nullable();
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->char('uf', 2);
            $table->string('pc_rv')->nullable();
            $table->text('descricao_servico')->nullable();
            $table->date('inicio_previsto')->nullable();
            $table->date('termino_previsto')->nullable();
            $table->string('licenca')->nullable();
            $table->date('inicio_licenca')->nullable();
            $table->date('termino_licenca')->nullable();
            $table->decimal('valor_projetado', 8, 2)->nullable();
            $table->decimal('comprimento_galeria', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_estacao')->references('id')->on('estacoes')->onUpdate('cascade');
            $table->foreign('id_cliente')->references('id')->on('clientes')->onUpdate('cascade');
            $table->foreign('id_tipo_servico')->references('id')->on('tipo_servicos')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projetos');
    }
}
