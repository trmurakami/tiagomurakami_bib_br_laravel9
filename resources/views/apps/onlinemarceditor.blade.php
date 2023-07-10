@extends('layouts.layout')

@section('title', 'Online MARC Editor')

@section('content')

<div id="onlinemarceditor">
    <onlinemarceditor />
</div>

<script src="{{ asset('js/onlinemarceditor.js') }}"></script>


@stop