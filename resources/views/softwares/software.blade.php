@extends('layouts.basemodel')

@section('title', 'Software')

@section('content')

<div class="container mt-3">

    <h1>{{ $id->name }}</h1>

    <h4>Instituições que o utilizam:</h4>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome da instituição</th>
                <th scope="col">Número de Bibliotecas</th>
                <th scope="col">Versão do software</th>
                <th scope="col">URL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($id->things as $thing)
            <tr>
                <th scope="row"><a href="thing/{{ $thing->id }}">{{ $thing->name }}</a></th>
                <td>{{ $thing->getOriginal()['pivot_number_of_branchs'] }}</td>
                <td>{{ $thing->getOriginal()['pivot_software_version'] }}</td>
                <td><a href="{{ $thing->getOriginal()['pivot_url'] }}" target="_blank"
                        rel="noopener noreferrer">{{ $thing->getOriginal()['pivot_url'] }}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@stop