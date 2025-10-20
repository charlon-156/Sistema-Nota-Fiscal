<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('cupons_fiscais', function (Blueprint $table) {
        $table->id();
        $table->foreignId('instituicao_id')->constrained()->onDelete('cascade');
        $table->string('numero_cupom');
        $table->string('coo'); // Contador Ordem Operação
        $table->date('data_emissao');
        $table->time('hora_emissao');
        $table->decimal('valor_total', 10, 2);
        $table->string('cpf_consumidor', 11)->nullable();
        $table->text('observacoes')->nullable();
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
        Schema::dropIfExists('cupom_fiscals');
    }
};
