@extends('layouts.layout')

@section('title', 'Classificador SDG utilizando a API Aurora SDG')

@section('content')

<div class="container">
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Classificador SDG utilizando a API Aurora SDG</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Enviar um TSV (arquivo separado por tab) com 2 colunas: TITULO e RESUMO.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <form class="m-3" action="aurorasdg" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    @csrf
                    <legend>Inserir um TSV</legend>
                    <div class="input-group">
                        <input type="file" class="custom-file-input" id="file" aria-describedby="file" name="file">
                        <button class="btn btn-primary" type="submit">Enviar TSV</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</main>

@stop