@extends('layouts.basemodel')

@section('title', 'Adicionar software')

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Adicionar software</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('softwares.index') }}"> Voltar</a>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('softwares.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nome do software:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Nome do software">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <strong>Categoria:</strong>
                    <input type="text" name="applicationcategory" class="form-control" placeholder="Categoria">
                </div>
                <div class="form-group">
                    <strong>Descrição:</strong>
                    <textarea type="text" name="description" class="form-control" placeholder="Descrição"></textarea>
                </div>
                <div class="form-group">
                    <strong>Mantenedor:</strong>
                    <input type="text" name="maintainer" class="form-control" placeholder="Mantenedor">
                </div>
                <div class="form-group">
                    <strong>Licença:</strong>
                    <input type="text" name="license" class="form-control" placeholder="Licença">
                </div>
                <div class="form-group">
                    <strong>URL:</strong>
                    <input type="text" name="url" class="form-control" placeholder="URL">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Criar</button>
        </div>
    </form>
</div>

@stop