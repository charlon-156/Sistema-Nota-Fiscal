<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    use HasFactory;

    protected $fillable = [
        'instituicao_id', 'numero_nota', 'serie',
        'data_emissao', 'valor_total', 'chave_acesso', 
        'tipo_operacao', 'destinatario', 'observacoes'
    ];

    protected $casts = [
        'data_emissao' => 'date',
        'valor_total' => 'decimal:2',
    ];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class);
    }
}