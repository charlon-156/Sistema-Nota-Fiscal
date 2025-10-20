<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
     public function index()
    {
        $notas = NotaFiscal::with('instituicao')
            ->orderBy('data_emissao', 'desc')
            ->paginate(10);

        return view('notas.index', compact('notas'));
    }

    public function create()
    {
        $instituicoes = Instituicao::all();
        return view('notas.create', compact('instituicoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'instituicao_id' => 'required|exists:instituicoes,id',
            'numero_nota' => 'required|string',
            'data_emissao' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'tipo_operacao' => 'required|in:entrada,saida',
        ]);

        NotaFiscal::create($request->all());

        return redirect()->route('notas.index')
            ->with('success', 'Nota fiscal cadastrada com sucesso!');
    }

    public function show(NotaFiscal $nota)
    {
        return view('notas.show', compact('nota'));
    }

    public function edit(NotaFiscal $nota)
    {
        $instituicoes = Instituicao::all();
        return view('notas.edit', compact('nota', 'instituicoes'));
    }

    public function update(Request $request, NotaFiscal $nota)
    {
        $request->validate([
            'instituicao_id' => 'required|exists:instituicoes,id',
            'numero_nota' => 'required|string',
            'data_emissao' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'tipo_operacao' => 'required|in:entrada,saida',
        ]);

        $nota->update($request->all());

        return redirect()->route('notas.index')
            ->with('success', 'Nota fiscal atualizada com sucesso!');
    }

    public function destroy(NotaFiscal $nota)
    {
        $nota->delete();

        return redirect()->route('notas.index')
            ->with('success', 'Nota fiscal excluída com sucesso!');
    }

    // 🔍 RELATÓRIOS
    public function relatorios()
    {
        $instituicoes = Instituicao::all();
        
        // Últimos 7 dias por padrão
        $dataInicio = now()->subDays(7)->format('Y-m-d');
        $dataFim = now()->format('Y-m-d');

        return view('notas.relatorios', compact('instituicoes', 'dataInicio', 'dataFim'));
    }

    public function gerarRelatorio(Request $request)
    {
        $request->validate([
            'instituicao_id' => 'nullable|exists:instituicoes,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date',
        ]);

        $query = NotaFiscal::with('instituicao')
            ->whereBetween('data_emissao', [
                $request->data_inicio, 
                $request->data_fim
            ]);

        if ($request->instituicao_id) {
            $query->where('instituicao_id', $request->instituicao_id);
        }

        $notas = $query->orderBy('data_emissao', 'desc')->get();

        // Export CSV
        if ($request->has('exportar_csv')) {
            return $this->exportarCSV($notas);
        }

        return view('notas.relatorios')
            ->with('notas', $notas)
            ->with('instituicoes', Instituicao::all())
            ->with('filtros', $request->all());
    }

    // 📤 EXPORTAR CSV
    private function exportarCSV($notas)
    {
        $fileName = 'notas_fiscais_' . date('Y-m-d_H-i') . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($notas) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'ID',
                'Instituição',
                'Número NF',
                'Série',
                'Data Emissão',
                'Valor Total',
                'Tipo Operação',
                'Destinatário',
                'Chave Acesso'
            ]);

            foreach ($notas as $nota) {
                fputcsv($file, [
                    $nota->id,
                    $nota->instituicao->nome,
                    $nota->numero_nota,
                    $nota->serie,
                    $nota->data_emissao->format('d/m/Y'),
                    number_format($nota->valor_total, 2, ',', '.'),
                    $nota->tipo_operacao == 'entrada' ? 'Entrada' : 'Saída',
                    $nota->destinatario,
                    $nota->chave_acesso
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

