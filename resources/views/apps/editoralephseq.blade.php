@extends('layouts.basemodel')

@section('title', 'Online MARC Editor')

@section('content')

<div id="editoralephseq">
    <editoralephseq />
</div>

<script src="{{ asset('js/editoralephseq.js') }}"></script>


@stop