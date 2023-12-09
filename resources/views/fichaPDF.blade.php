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
        font-family: monospace;
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
    <p style="text-align: center;">CIP - Catalogação na Publicação</p>
    <div class="ficha-catalografica">
        <p>{{ $sobrenome }}, {{ $nome }}</p>
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
    <p style="text-align: center;">
        Elaborado pelo Gerador de ficha catalográfica para trabalhos acadêmicos com os dados fornecidos pelo(a) autor(a)
    </p>
</body>

</html>