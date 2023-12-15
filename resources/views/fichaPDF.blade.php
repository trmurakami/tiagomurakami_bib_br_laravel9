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
        font-size: 12px;
        font-family: monospace;
        line-height: 1.5;
        display: flex;
        justify-content: space-between;
    }

    .ficha-catalografica h1 {
        text-align: center;
    }

    .ficha-catalografica p {
        margin: 0;
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

    <p style="text-align: center;">CIP - Catalogação na Publicação</p>
    <div class="ficha-catalografica">
        <p>{{ $cutter }}{{ strtolower($titulo[0]) }}</p>
        <div style="padding:30px">
            <p>{{ $sobrenome }}, {{ $nome }}</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $titulo }} / {{ $nome }} {{ $sobrenome }}. — {{ $cidade }}, {{ $ano }}.
            </p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $folhas }} f.
                @if ($ilustrado == ': il.')
                : il.
                @endif
            </p>
            <br />
            <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $genero_orientador }}: {{ $titulacao_orientador }} {{ $nome_orientador }}
                {{ $sobrenome_orientador }}.
            </p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $grau }} — {{ $instituicao }},
                @if (!empty($graduacao))
                {{ $graduacao }},
                @endif
                @if (!empty($ppg))
                {{ $ppg }},
                @endif
                @if (!empty($especializacao))
                {{ $especializacao }},
                @endif
                {{ $ano }}.
            </p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;
                @php
                $assuntos_array = explode(",", $assuntos);
                @endphp
                @foreach ($assuntos_array as $key => $assunto)
                {{ $key + 1 }}. {{ $assunto }}.&nbsp;
                @endforeach
                I. {{ $sobrenome_orientador }},
                {{ $nome_orientador }}. II.
                {{ $titulo }}.
            </p>
        </div>
    </div>
    <p style="text-align: center; margin-bottom: 0; font-size:11px">
        <small>Elaborado pelo Gerador de ficha catalográfica para trabalhos acadêmicos</small>
    </p>
    <p style="text-align: center; margin: 0; font-size:11px">
        <small>com os dados fornecidos pelo(a) autor(a), sob a responsabilidade de</small>
    </p>
    <p style="text-align: center; margin: 0; font-size:11px">
        <small>Tiago Rodrigo Marçal Murakami - CRB-8/7555.</small>
    </p>

</body>

</html>