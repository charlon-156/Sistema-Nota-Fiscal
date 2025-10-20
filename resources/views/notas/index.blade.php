@extends('layouts.app')

@section('title', 'Notas Fiscais i index')

@section('content')

<div class="container mt-5">
    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class= fw-bold mt-4">
            <i class="fas fa-file-invoice me-2"></i> Notas Fiscais
        </h1>
        <div>
            <a href="{{ route('notas.relatorios') }}" class="btn btn-info me-2">
                <i class="fas fa-chart-bar me-2"></i>Relatórios
            </a>
            <a href="{{ route('notas.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Nova Nota Fiscal
            </a>
        </div>
    </div>

    <!-- Card Principal -->
    <div class="card shadow-lg">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Filtros Rápidos -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <input type="text" class="form-control border-secondary" 
                           placeholder="Buscar por número..." id="searchInput">
                </div>
                <div class="col-md-3">
                    <select class="form-control border-secondary" id="tipoFilter">
                        <option value="">Todos os tipos</option>
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control border-secondary" id="instituicaoFilter">
                        <option value="">Todas as instituições</option>
                        @foreach($instituicoes ?? [] as $inst)
                            <option value="{{ $inst->id }}">{{ $inst->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100" onclick="limparFiltros()">
                        <i class="fas fa-times me-1"></i>Limpar
                    </button>
                </div>
            </div>

            <!-- Tabela de Notas Fiscais -->
            @if($notas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-dark table-hover" id="notasTable">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Instituição</th>
                                <th>Data Emissão</th>
                                <th>Valor Total</th>
                                <th>Tipo</th>
                                <th>Destinatário</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notas as $nota)
                                <tr>
                                    <td>
                                        <strong>{{ $nota->numero_nota }}</strong>
                                        @if($nota->serie)
                                            <small class="text-muted">/{{ $nota->serie }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $nota->instituicao->nome }}
                                        </span>
                                    </td>
                                    <td>{{ $nota->data_emissao->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="fw-bold text-success">
                                            R$ {{ number_format($nota->valor_total, 2, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($nota->tipo_operacao == 'entrada')
                                            <span class="badge bg-info">
                                                <i class="fas fa-arrow-down me-1"></i>Entrada
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-arrow-up me-1"></i>Saída
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($nota->destinatario)
                                            <small>{{ Str::limit($nota->destinatario, 20) }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('notas.show', $nota->id) }}" 
                                               class="btn btn-outline-info" 
                                               title="Visualizar">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('notas.edit', $nota->id) }}" 
                                               class="btn btn-outline-warning" 
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-outline-danger" 
                                                    title="Excluir"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $nota->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Modal de Confirmação de Exclusão -->
                                        <div class="modal fade" id="deleteModal{{ $nota->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header border-secondary">
                                                        <h5 class="modal-title">Confirmar Exclusão</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Tem certeza que deseja excluir a nota fiscal <strong>{{ $nota->numero_nota }}</strong>?</p>
                                                        <p class="text-warning">
                                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                                            Esta ação não pode ser desfeita.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer border-secondary">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('notas.destroy', $nota->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Excluir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class=">
                        Mostrando {{ $notas->firstItem() }} a {{ $notas->lastItem() }} de {{ $notas->total() }} registros
                    </div>
                    <nav>
                        {{ $notas->links() }}
                    </nav>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-file-invoice fa-4x text-muted mb-3"></i>
                    <h4 class=">Nenhuma nota fiscal encontrada</h4>
                    <p class="text-muted">Comece cadastrando sua primeira nota fiscal</p>
                    <a href="{{ route('notas.create') }}" class="btn btn-success mt-3">
                        <i class="fas fa-plus me-2"></i>Cadastrar Primeira Nota
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Filtros simples na tabela
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tipoFilter = document.getElementById('tipoFilter');
    const instituicaoFilter = document.getElementById('instituicaoFilter');
    const table = document.getElementById('notasTable');
    const rows = table ? table.getElementsByTagName('tbody')[0].getElementsByTagName('tr') : [];

    function filtrarTabela() {
        const searchText = searchInput.value.toLowerCase();
        const tipoValue = tipoFilter.value;
        const instituicaoValue = instituicaoFilter.value;

        for (let row of rows) {
            const cells = row.getElementsByTagName('td');
            const numero = cells[0].textContent.toLowerCase();
            const instituicao = cells[1].textContent;
            const tipo = cells[4].textContent.toLowerCase();
            const instituicaoId = row.getAttribute('data-instituicao-id') || '';

            const matchSearch = numero.includes(searchText);
            const matchTipo = !tipoValue || tipo.includes(tipoValue);
            const matchInstituicao = !instituicaoValue || instituicaoId === instituicaoValue;

            row.style.display = (matchSearch && matchTipo && matchInstituicao) ? '' : 'none';
        }
    }

    if (searchInput) searchInput.addEventListener('input', filtrarTabela);
    if (tipoFilter) tipoFilter.addEventListener('change', filtrarTabela);
    if (instituicaoFilter) instituicaoFilter.addEventListener('change', filtrarTabela);
});

function limparFiltros() {
    document.getElementById('searchInput').value = '';
    document.getElementById('tipoFilter').value = '';
    document.getElementById('instituicaoFilter').value = '';
    
    const rows = document.querySelectorAll('#notasTable tbody tr');
    rows.forEach(row => row.style.display = '');
}
</script>

<style>
.table-dark {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
}

.table-dark th {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    font-weight: 600;
}

.table-dark td {
    border-color: rgba(255, 255, 255, 0.05);
    vertical-align: middle;
}

.btn-group-sm > .btn {
    padding: 0.25rem 0.5rem;
}

.badge {
    font-size: 0.75em;
}
</style>

@endsection