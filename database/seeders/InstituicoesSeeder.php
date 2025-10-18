<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstituicoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instituicaos')->insert([
            [
                'nome' => 'Empresa Alfa LTDA',
                'cnpj' => '12345678000199',
                'endereco' => 'Av. Paulista, 1000 - São Paulo/SP',
                'telefone' => '(11) 3333-4444',
                'natureza_juridica' => 'Fundação Privada',
                'email' => 'contato@alfa.com.br',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Fornecedor Beta S/A',
                'cnpj' => '98765432000155',
                'endereco' => 'Rua das Flores, 250 - Rio de Janeiro/RJ',
                'telefone' => '(21) 2222-8888',
                'natureza_juridica' => 'Sociedade Anônima Aberta',
                'email' => 'suporte@beta.com.br',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Cliente Gama ME',
                'cnpj' => '11122233000177',
                'endereco' => 'Rua Central, 50 - Belo Horizonte/MG',
                'telefone' => '(31) 99999-5555',
                'natureza_juridica' => 'Empresário (Individual)',
                'email' => 'gama@cliente.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
