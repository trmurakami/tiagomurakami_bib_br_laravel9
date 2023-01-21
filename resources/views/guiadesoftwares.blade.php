@extends('layouts.basemodel')

@section('title', 'Guia de softwares')

@section('content')

<div class="container">

    <h1>Guia de softwares</h1>

    <p>O Guia de softwares para Bibliotecas e Unidades de Informação é banco de dados com o registro dos principais
        softwares utilizado por
        Instituições brasileiras para a gestão de recursos informacionais.</p>

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{ count($softwares) }}</h5>
            <p class="card-text">Softwares registrados</p>
        </div>
    </div>


    <div class="row mt-3">
        @foreach ($softwares as $software)
        <div class="col-sm-6 mt-3">
            <div class="card">
                <img src="" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $software->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $software->applicationcategory }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $software->maintainer }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $software->license }}</h6>
                    <p class="card-text">{{ $software->description }}</p>
                    <a href="software/{{ $software->id }}" class="btn btn-primary">Saiba mais</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>



    @stop