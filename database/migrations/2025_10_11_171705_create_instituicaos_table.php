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
        Schema::create('instituicaos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('cnpj', 14)->unique();
        $table->string('endereco')->nullable();
        $table->string('telefone')->nullable();
        $table->string('natureza_juridica');
        $table->date('data_abertura');
        $table->string('situação_cadastral');
        $table->string('email')->nullable();
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
        Schema::dropIfExists('instituicaos');
    }
};
