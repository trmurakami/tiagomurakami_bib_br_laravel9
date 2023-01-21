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
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('things.index') }}" enctype="multipart/form-data">
                    Voltar</a>
            </div>
            <div class="pull-left">
                <h2>Editar instituição</h2>
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
                    <strong>Site da instituição:</strong>
                    <input type="url" name="url" value="{{ $thing->url }}" class="form-control"
                        placeholder="Site da instituição">
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

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome do software</th>
                <th scope="col">Função</th>
                <th scope="col">Versão</th>
                <th scope="col">Número de bibliotecas</th>
                <th scope="col">Número de registros</th>
                <th scope="col">URL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($thing->softwares as $softwares_used)
            <th scope="row"><a href="thing/{{ $softwares_used->id }}">{{ $softwares_used->name }}</a></th>
            <th scope="row">{{ $softwares_used->getOriginal('pivot_function') }}</th>
            <th scope="row">{{ $softwares_used->getOriginal('pivot_software_version') }}</th>
            <th scope="row">{{ $softwares_used->getOriginal('pivot_number_of_branchs') }}</th>
            <th scope="row">{{ $softwares_used->getOriginal('pivot_number_of_records') }}</th>
            <th scope="row"><a href="{{ $softwares_used->getOriginal('pivot_url') }}"
                    target="_blank">{{ $softwares_used->getOriginal('pivot_url') }}</a>
            </th>
            @endforeach


        </tbody>
    </table>

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
            <option value="Sistema Integrado de Gestão de Bibliotecas (SIGB)">Sistema Integrado de Gestão de Bibliotecas
                (SIGB)</option>
            <option value="Repositório institucional (RI)">Repositório institucional (RI)</option>
            <option value="Vocabulário controlado (VC)">Vocabulário controlado (VC)</option>
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