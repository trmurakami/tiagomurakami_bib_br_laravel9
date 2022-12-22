@extends('layouts.basemodel')

@section('title', 'Adicionar instituição')

@section('content')


<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Adicionar instituição</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('things.index') }}"> Voltar</a>
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
                    <input type="text" name="schema_org_type" class="form-control" value="Organization" disabled
                        readonly>
                </div>
                <div class="form-group">
                    <strong>Nome da instituição:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Instituição">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Criar</button>
        </div>
    </form>
</div>

@stop