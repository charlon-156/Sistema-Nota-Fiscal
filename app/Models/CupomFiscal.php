<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CupomFiscal extends Model
{
    use HasFactory;

    protected $fillable = [
        'instituicao_id', 'numero_cupom', 'coo', 'data_emissao',
        'hora_emissao', 'valor_total', 'cpf_consumidor', 'observacoes'
    ];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }
}