<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class InstituicaoController extends Controller
{
    public function index()
    {
        $instituicoes = Instituicao::all();
        return view('instituicoes.index', compact('instituicoes'));
    }

    public function create()
    {
        return view('instituicoes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cnpj' => 'required|unique:instituicoes|max:14',
        ]);

        Instituicao::create($request->all());

        return redirect()->route('instituicoes.index')
            ->with('success', 'Instituição criada com sucesso.');
    }

    public function show($id)
    {
        $instituicao = Instituicao::find($id);
        return view('instituicoes.show', compact('instituicao'));
    }

    public function edit(Instituicao $instituicao)
    {
        return view('instituicoes.edit', compact('instituicao'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'cnpj' => 'required|max:14',
        ]);

        $instituicao = Instituicao::find($id);

        $instituicao->update([
            'nome' => $request->nome,
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco,
            'telefone' => $request->telefone,
            'natureza_juridica' => $request->natureza_juridica,
            'situacao_cadastral' => $request->situacao_cadastral,
            'data_abertura' => $request->data_abertura,
        ]);

        return redirect()->route('instituicoes.index')
            ->with('success', 'Instituição atualizada com sucesso');
    }

    public function destroy(Instituicao $instituicao)
    {
        $instituicao->delete();

        return redirect()->route('instituicoes.index')
            ->with('success', 'Instituição deletada com sucesso');
    }
}