@extends('layouts.layout')

@section('title', 'BibliotECA - Editor de registros')

@section('content')
<div id="editor">
    <editor :work="{{ $work }}"></editor>
    <script>
    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>

</div>
<script src="{{ mix('js/editor.js') }}"></script>
@endsection