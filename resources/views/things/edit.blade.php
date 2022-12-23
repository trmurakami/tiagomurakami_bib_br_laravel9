@extends('layouts.basemodel')

@section('title', 'Editar instituição')

@section('content')

@php
use App\Models\Software;
use App\Models\Thing;

$softwares = Software::get();

@endphp


<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar instituição</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('things.index') }}" enctype="multipart/form-data">
                    Voltar</a>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('things.update', $thing->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipo Schema.org:</strong>
                    <input type="text" name="schema_org_type" class="form-control" value="Organization" disabled
                        readonly>
                </div>
                <div class="form-group">
                    <strong>Nome da instituição:</strong>
                    <input type="text" name="name" value="{{ $thing->name }}" class="form-control"
                        placeholder="Instituição">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Enviar</button>
    </form>

    @if ($thing->softwares)
    <h4 class="mt-3">Softwares utilizados</h4>
    <ul class="list-group">
        @foreach ($thing->softwares as $softwares_used)
        <li class="list-group-item">{{ $softwares_used->name }}</li>
        @endforeach
    </ul>
    @endif

    <h4 class="mt-3">Adicionar um software usado por {{ $thing->name }}:</h4>
    <form action="/softwaretothing" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        <input type="hidden" name="thing_id" value="{{ $thing->id }}">

        <select class="form-select" aria-label="Select software" name="software_id">
            <option selected>Escolha um software</option>
            @foreach ($softwares as $software)
            <option value="{{ $software->id }}">{{ $software->name }}</option>
            @endforeach
        </select>
        <select class="form-select" aria-label="Função" name="function">
            <option selected>Escolha a função</option>
            <option value="SGB">Sistema Integrado de Gestão de Bibliotecas (SIGB)</option>
            <option value="REP">Repositórios institucionais (RI)</option>
        </select>
        <input class="form-control" type="text" placeholder="Versão" aria-label="Versão" name="software_version">
        <input class="form-control" type="number" placeholder="Número de bibliotecas" aria-label="Número de bibliotecas"
            name="number_of_branchs">
        <input class="form-control" type="number" placeholder="Número de registros" aria-label="Número de registros"
            name="number_of_records">
        <input class="form-control" type="url" placeholder="URL" aria-label="URL" name="url">

        <button type="submit" class="mt-3 btn btn-primary">Enviar</button>

    </form>
</div>

@stop