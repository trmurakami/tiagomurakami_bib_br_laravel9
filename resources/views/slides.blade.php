@extends('layouts.layout')

@section('title', 'Slides de apresentações')

@section('content')

<div class="container">
    <h1>Slides de apresentações</h1>
    <p>Página para o compartilhamento de slides de apresentações</p>
    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="card">
                <img src="includes/images/Librecat-Catmandu.png" class="card-img-top"
                    alt="Slides da apresentação sobre o Librecat-Catmandu">
                <div class="card-body">
                    <h5 class="card-title">Librecat / Catmandu</h5>
                    <p class="card-text">Slides apresentados em vídeo no Youtube sobre o Librecat / Catmandu.
                        <br />Ano: 2023
                    </p>
                    <a href="files/Librecat-Catmandu.pptx" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <img src="includes/images/PPT_schema_org.png" class="card-img-top"
                    alt="Slides da apresentação sobre o Schema.org">
                <div class="card-body">
                    <h5 class="card-title">Uma visão sobre o schema.org para as bibliotecas</h5>
                    <p class="card-text">Slides apresentados no Grupo de Catalogação.
                        <br />Ano: 2021
                    </p>
                    <a href="files/UmaVisaoSobreOSchema_org.pptx" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-6">
            <div class="card">
                <img src="includes/images/SlidesIA.png" class="card-img-top"
                    alt="Slides da apresentação Desmistificando a IA para os bibliotecários">
                <div class="card-body">
                    <h5 class="card-title">Desmistificando a IA para os bibliotecários</h5>
                    <p class="card-text">Slides apresentados em vídeo no <a
                            href="https://www.youtube.com/watch?v=5DrOXBih4cw">Youtube</a>.
                        <br />Ano: 2024
                    </p>
                    <a href="files/IA_Murakami.pptx" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop