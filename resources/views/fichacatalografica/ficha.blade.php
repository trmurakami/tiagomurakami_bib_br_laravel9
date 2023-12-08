@extends('layouts.layout')

@section('title', 'Gerador de Ficha Catalográfica')

@section('content')
<div id="ficha">
    <ficha></ficha>
</div>

<script src="{{ mix('js/ficha.js') }}"></script>
@endsection