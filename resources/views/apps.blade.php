@extends('layouts.basemodel')

@section('title', 'Aplicativos online')

@section('content')

<div class="row mt-3">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Online MARC Editor</h5>
                <p class="card-text">Editor MARC.</p>
                <a href="onlinemarceditor" class="btn btn-primary">Acessar</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Editor ALEPHSEQ para a Produção Científica USP</h5>
                <p class="card-text">Editor.</p>
                <a href="editoralephseq" class="btn btn-primary">Acessar</a>
            </div>
        </div>
    </div>
</div>

@stop