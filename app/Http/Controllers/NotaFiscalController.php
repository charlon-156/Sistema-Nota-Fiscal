<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    public function index()
    {
        $notasFiscais = NotaFiscal::with('instituicao')->get();
        return view('notas-fiscais.index', compact('notasFiscais'));
    }

    public function create()
    {
        $instituicoes = Instituicao::all();
        return view('notas-fiscais.create', compact('instituicoes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required',
            'serie' => 'required',
            'valor' => 'required|numeric',
            'data_emissao' => 'required|date',
            'instituicao_id' => 'required|exists:instituicoes,id',
        ]);

        NotaFiscal::create($request->all());

        return redirect()->route('notas-fiscais.index')
            ->with('success', 'Nota fiscal criada com sucesso.');
    }

    public function show(NotaFiscal $notaFiscal)
    {
        return view('notas-fiscais.show', compact('notaFiscal'));
    }

    public function edit(NotaFiscal $notaFiscal)
    {
        $instituicoes = Instituicao::all();
        return view('notas-fiscais.edit', compact('notaFiscal', 'instituicoes'));
    }

    public function update(Request $request, NotaFiscal $notaFiscal)
    {
        $request->validate([
            'numero' => 'required',
            'serie' => 'required',
            'valor' => 'required|numeric',
            'data_emissao' => 'required|date',
            'instituicao_id' => 'required|exists:instituicoes,id',
        ]);

        $notaFiscal->update($request->all());

        return redirect()->route('notas-fiscais.index')
            ->with('success', 'Nota fiscal atualizada com sucesso');
    }

    public function destroy(NotaFiscal $notaFiscal)
    {
        $notaFiscal->delete();

        return redirect()->route('notas-fiscais.index')
            ->with('success', 'Nota fiscal deletada com sucesso');
    }
}
