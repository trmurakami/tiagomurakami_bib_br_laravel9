@extends('layouts.layout')

@section('title', 'Aplicativos online')

@section('content')

<div class="container">
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
        <div class="col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Conversor online de XML do Currículo Lattes em formato Bibtex para importação
                        no
                        ORCID</h5>
                    <p class="card-text">Conversor.</p>
                    <a href="lattestobibtex" class="btn btn-primary">Acessar</a>
                </div>
            </div>

        </div>
        <div class="col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Consultar Tabela Cutter Sanborn</h5>
                    <p class="card-text">Consultar Tabela Cutter Sanborn</p>
                    <a href="cutter" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ferramentas MARC</h5>
                    <p class="card-text">Ferramentas MARC</p>
                    <a href="marc" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Classificador Machine Learning usando TNTSearch</h5>
                    <p class="card-text">Classificador Machine Learning usando TNTSearch</p>
                    <a href="classificador/consulta" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Consulta Qualis Periódicos</h5>
                    <p class="card-text">Consulta Qualis Periódicos</p>
                    <a href="qualis" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Classificador SDGs usando Tensorflow</h5>
                    <p class="card-text">Classificador SDGs</p>
                    <a href="https://tiagomurakami.bib.br/sdg" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Classificador SDGs usando Aurora API</h5>
                    <p class="card-text">Classificador SDGs</p>
                    <a href="https://tiagomurakami.bib.br/aurorasdg" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Classificador Ciência da Informação usando Tensorflow</h5>
                    <p class="card-text">Classificador Ciência da Informação</p>
                    <a href="https://tiagomurakami.bib.br/classificadorci" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>

    </div>
</div>

@stop