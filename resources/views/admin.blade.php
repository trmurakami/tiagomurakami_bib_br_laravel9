@extends('layouts.layout')

@section('title', 'Administração')

@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Softwares</h5>
                    <p class="card-text">Lista de softwares.</p>
                    <a href="softwares" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Instituições</h5>
                    <p class="card-text">Lista de Instituições.</p>
                    <a href="things" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop