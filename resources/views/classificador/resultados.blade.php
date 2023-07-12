@extends('layouts.layout')

@section('title', 'BibliotECA - Resultado da consulta no classificador')

@section('content')




<div class="container">
    <h3 class="mt-3 mb-3">Resultados da consulta no classificador</h3>
    <div class="alert alert-primary" role="alert">
        <p>Você pesquisou por: <strong>{{ $request->string }}</strong></p>
        <p>A nota obtida foi: <strong>{{ $results['likelihood'] }}</strong></p>
        <p>A melhor classificação obtida foi: <strong>{{ $results['label'] }}</strong></p>
        <p>Probabilidades:</p>
        <ul>
            @foreach ($results['probability'] as $key => $value)
            @if ($value > 0.01)
            <li>{{ $key }}: {{ $value }}</li>
            @endif
            @endforeach
        </ul>
    </div>
</div>

@endsection