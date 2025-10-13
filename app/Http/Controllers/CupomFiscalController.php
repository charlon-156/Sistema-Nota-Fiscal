<?php


namespace App\Http\Controllers;

use App\Models\CupomFiscal;
use Illuminate\Http\Request;

class CupomFiscalController extends Controller
{
    public function index()
    {
        $cuponsFiscais = CupomFiscal::all();
        return view('cupons-fiscais.index', compact('cuponsFiscais'));
    }

    public function create()
    {
        return view('cupons-fiscais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required',
            'valor' => 'required|numeric',
            'data_emissao' => 'required|date',
            'estabelecimento' => 'required',
        ]);

        CupomFiscal::create($request->all());

        return redirect()->route('cupons-fiscais.index')
            ->with('success', 'Cupom fiscal criado com sucesso.');
    }

    public function show(CupomFiscal $cupomFiscal)
    {
        return view('cupons-fiscais.show', compact('cupomFiscal'));
    }

    public function edit(CupomFiscal $cupomFiscal)
    {
        return view('cupons-fiscais.edit', compact('cupomFiscal'));
    }

    public function update(Request $request, CupomFiscal $cupomFiscal)
    {
        $request->validate([
            'numero' => 'required',
            'valor' => 'required|numeric',
            'data_emissao' => 'required|date',
            'estabelecimento' => 'required',
        ]);

        $cupomFiscal->update($request->all());

        return redirect()->route('cupons-fiscais.index')
            ->with('success', 'Cupom fiscal atualizado com sucesso');
    }

    public function destroy(CupomFiscal $cupomFiscal)
    {
        $cupomFiscal->delete();

        return redirect()->route('cupons-fiscais.index')
            ->with('success', 'Cupom fiscal deletado com sucesso');
    }
}