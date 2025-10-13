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
        Schema::create('notas_fiscais', function (Blueprint $table) {
        $table->id();
        $table->string('numero');
        $table->string('serie');
        $table->decimal('valor', 10, 2);
        $table->date('data_emissao');
        $table->foreignId('instituicao_id')->constrained()->onDelete('cascade');
        $table->text('descricao')->nullable();
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
