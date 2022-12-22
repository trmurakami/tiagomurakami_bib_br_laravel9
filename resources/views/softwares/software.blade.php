@extends('layouts.basemodel')

@section('title', 'Software')

@section('content')

<div class="container mt-3">

    <h1>{{ $id->name }}</h1>

    <h2>Instituições que utilizam</h2>

    <ul>
        @foreach ($id->things as $thing)
        <li>{{ $thing->name }}</li>
        @endforeach
    </ul>

</div>

@stop