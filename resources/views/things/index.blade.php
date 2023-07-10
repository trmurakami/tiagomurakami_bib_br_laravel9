@extends('layouts.layout')

@section('title', 'Administração - Instituições')

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administração - Instituições</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('things.create') }}"> Criar Instituição</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Número</th>
                <th>Instituição</th>
                <th width="280px">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($things as $thing)
            <tr>
                <td>{{ $thing->id }}</td>
                <td>{{ $thing->name }}</td>
                <td>
                    <form action="{{ route('things.destroy', $thing->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('things.edit', $thing->id) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $things->links() !!}
</div>

@stop