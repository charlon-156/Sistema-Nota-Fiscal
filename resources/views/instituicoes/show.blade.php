@extends('layouts.app')

@section('title', '# - Instituições')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-light fw-bold mt-4">
            <i class="fas fa-building me-2"></i> #{{$instituicao->id}} - {{$instituicao->nome}}
        </h1>
    </div>

