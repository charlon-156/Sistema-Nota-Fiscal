<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cnpj',
        'endereco',
        'telefone',
        'email',
    ];

    public function notasFiscais()
    {
        return $this->hasMany(NotaFiscal::class);
    }
}