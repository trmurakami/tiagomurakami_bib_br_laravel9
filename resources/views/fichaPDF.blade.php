<!DOCTYPE html>
<html>

<head>
    <title>Ficha catalográfica</title>
    <style>
    /* Adicione aqui o seu CSS */
    .ficha-catalografica {
        width: 70%;
        margin: auto;
        border: 1px solid #000;
        padding: 20px;
        font-size: 14px;
        line-height: 1.5;
    }

    .ficha-catalografica h1 {
        text-align: center;
    }

    .ficha-catalografica p {
        text-indent: 50px;
    }
    </style>
</head>

<body>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <div class="ficha-catalografica">
        <h1>{{ $sobrenome }}, {{ $nome }}</h1>
        <p><strong>{{ $titulo }}</strong> / {{ $nome }} {{ $sobrenome }}. — {{ $ano }}.
        </p>
        <p>{{ $folhas }} f.
            @if ($ilustrado == ': il.')
            : il.
            @endif
        </p>
        <p>{{ $genero_orientador }}: {{ $nome_orientador }} {{ $sobrenome_orientador }}.</p>
        <p>Tese (doutorado) — {{ $instituicao }}, PPG, {{ $ano }}.</p>
        <p>1. Assunto. 2. Assunto. I. {{ $sobrenome_orientador }}, {{ $nome_orientador }}. II. {{ $titulo }}.</p>
    </div>
</body>

</html>