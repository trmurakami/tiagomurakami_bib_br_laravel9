@extends('layouts.layout')

@section('title', 'Adicionar instituição')

@section('content')


<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('things.index') }}"> Voltar</a>
            </div>
            <div class="pull-left mb-2">
                <h2>Adicionar instituição</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('things.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tipo Schema.org:</strong>
                    <select class="form-select" aria-label="Schema Org Type" name="schema_org_type">
                        <option value="Organization" selected>Organização</option>
                    </select>
                    <strong>Nome da instituição:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Instituição">
                    <strong>Site da instituição:</strong>
                    <input type="url" name="url" class="form-control" placeholder="Site da instituição">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Criar</button>
    </form>
</div>

@stop