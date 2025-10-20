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
        Schema::create('nota_fiscals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('instituicao_id')->constrained()->onDelete('cascade');
        $table->string('numero_nota');
        $table->string('serie')->default('1');
        $table->date('data_emissao');
        $table->decimal('valor_total', 10, 2);
        $table->string('chave_acesso', 44)->unique()->nullable();
        $table->enum('tipo_operacao', ['entrada', 'saida'])->default('saida');
        $table->string('destinatario')->nullable();
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
        Schema::dropIfExists('nota_fiscals');
    }
};
