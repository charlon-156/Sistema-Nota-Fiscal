@extends('layouts.app')

@section('title', 'Instituições - FiscalControl')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-light fw-bold">
            <i class="fas fa-building me-2"></i>Instituições
        </h1>
        <a href="{{ route('instituicoes.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Nova Instituição
        </a>
    </div>

    <!-- Mensagens de sucesso -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabela de instituições -->
    <div class="card bg-transparent text-light border-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle text-light">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Tipo</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($instituicoes as $instituicao)
                        <tr>
                            <td>{{ $instituicao->id }}</td>
                            <td>{{ $instituicao->nome }}</td>
                            <td>{{ $instituicao->cnpj ?? '—' }}</td>
                            <td>{{ ucfirst($instituicao->tipo ?? 'Não definido') }}</td>
                            <td class="text-end">
                                <a href="{{ route('instituicoes.show', $instituicao->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
