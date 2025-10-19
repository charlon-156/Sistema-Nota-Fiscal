@extends('layouts.app')

@section('title', '# - Instituições')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-light fw-bold mt-4">
            <i class="fas fa-building me-2"></i> #{{$instituicao->id}} - {{$instituicao->nome}}
        </h1>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <!-- Formulário de Edição -->
            <form id="editForm" action="{{ route('instituicoes.update', $instituicao->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nome" class="form-label text-light">Nome</label>
                        <input type="text" 
                               class="form-control bg-dark text-light border-secondary" 
                               id="nome" 
                               name="nome" 
                               value="{{ $instituicao->nome }}" 
                               disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cnpj" class="form-label text-light">CNPJ</label>
                        <input type="text" 
                               class="form-control bg-dark text-light border-secondary" 
                               id="cnpj" 
                               name="cnpj" 
                               value="{{ $instituicao->cnpj }}" 
                               disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="endereco" class="form-label text-light">Endereço</label>
                        <input type="text" 
                               class="form-control bg-dark text-light border-secondary" 
                               id="endereco" 
                               name="endereco" 
                               value="{{ $instituicao->endereco }}" 
                               disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefone" class="form-label text-light">Telefone</label>
                        <input type="text" 
                               class="form-control bg-dark text-light border-secondary" 
                               id="telefone" 
                               name="telefone" 
                               value="{{ $instituicao->telefone }}" 
                               disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="natureza_juridica" class="form-label text-light">Natureza Jurídica</label>
                        <input type="text" 
                               class="form-control bg-dark text-light border-secondary" 
                               id="natureza_juridica" 
                               name="natureza_juridica" 
                               value="{{ $instituicao->natureza_juridica }}" 
                               disabled>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="situacao_cadastral" class="form-label text-light">Situação Cadastral</label>
                        <input type="text" 
                               class="form-control bg-dark text-light border-secondary" 
                               id="situação_cadastral" 
                               name="situação_cadastral" 
                               value="{{ $instituicao->situação_cadastral }}" 
                               disabled>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="data_abertura" class="form-label text-light">Data de abertura</label>
                        <input type="date" 
                               class="form-control bg-dark text-light border-secondary" 
                               id="data_abertura" 
                               name="data_abertura" 
                               value="{{ $instituicao->data_abertura }}" 
                               disabled>
                    </div>
                </div>

                <!-- Botões -->
                <div class="d-flex gap-2 mt-4">
                    <button type="button" id="btnEdit" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Editar
                    </button>
                    
                    <button type="submit" id="btnSave" class="btn btn-success d-none">
                        <i class="fas fa-save me-2"></i>Salvar
                    </button>
                    
                    <button type="button" id="btnCancel" class="btn btn-secondary d-none">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>

                    <!-- Botão Delete com Confirmação -->
                    <button type="button" 
                            id="btnDelete" 
                            class="btn btn-danger ms-auto"
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmDeleteModal">
                        <i class="fas fa-trash me-2"></i>Excluir
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir a instituição <strong>{{ $instituicao->nome }}</strong>?
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('instituicoes.destroy', $instituicao->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editButton = document.getElementById('btnEdit');
    const saveButton = document.getElementById('btnSave');
    const cancelButton = document.getElementById('btnCancel');
    const formInputs = document.querySelectorAll('#editForm input');
    const deleteButton = document.getElementById('btnDelete');

    // Habilitar edição
    editButton.addEventListener('click', function() {
        formInputs.forEach(input => input.disabled = false);
        editButton.classList.add('d-none');
        saveButton.classList.remove('d-none');
        cancelButton.classList.remove('d-none');
        deleteButton.disabled = true;
    });

    // Cancelar edição
    cancelButton.addEventListener('click', function() {
        formInputs.forEach(input => input.disabled = true);
        editButton.classList.remove('d-none');
        saveButton.classList.add('d-none');
        cancelButton.classList.add('d-none');
        deleteButton.disabled = false;
        // Opcional: Recarregar valores originais
        document.getElementById('editForm').reset();
    });
});
</script>

@endsection