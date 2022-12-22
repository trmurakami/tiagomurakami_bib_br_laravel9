@extends('layouts.basemodel')

@section('title', 'Guia de softwares')

@section('content')

<div class="container">

    <h1>Guia de softwares</h1>

    Quantidade de softwares cadastrados: {{ count($softwares) }}

    @foreach ($softwares as $software)

    <div class="card" style="width: 18rem;">
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



@stop