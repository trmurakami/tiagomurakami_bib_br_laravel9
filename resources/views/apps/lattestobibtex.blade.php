@extends('layouts.basemodel')

@section('title', 'Conversor online de XML do Currículo Lattes em formato Bibtex para importação no ORCID')

@section('content')


<div class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold">Conversor online de XML do Currículo Lattes em formato Bibtex para importação
        no ORCID</h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Funcionando inicialmente com os tipos: Trabalhos em eventos, Artigos, Livros e
            Capítulos de Livros.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <form class="m-3" action="lattestobibtex" method="post" accept-charset="utf-8"
                enctype="multipart/form-data">
                @csrf
                <legend>Inserir um XML do Lattes</legend>
                <div class="input-group">
                    <input type="file" class="custom-file-input" id="fileXML" aria-describedby="fileXML" name="file">
                    <button class="btn btn-primary" type="submit">Enviar XML</button>
                </div>
            </form>
        </div>
    </div>
</div>

</main>

@stop