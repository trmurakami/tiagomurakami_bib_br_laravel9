@extends('layouts.basemodel')

@section('title', 'Consulta Tabela Cutter Sanborn')

@section('content')
<div id="cutter">
    <cutter></cutter>
</div>

<script src="{{ mix('js/cutter.js') }}"></script>
@endsection