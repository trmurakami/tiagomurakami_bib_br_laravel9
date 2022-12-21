@extends('layouts.basemodel')

@section('title', 'Administração - Softwares')

@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administração - Softwares</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('softwares.create') }}"> Criar software</a>
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
                <th>Nome do software</th>
                <th>Mantenedor</th>
                <th width="280px">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($softwares as $software)
            <tr>
                <td>{{ $software->id }}</td>
                <td>{{ $software->name }}</td>
                <td>{{ $software->maintainer }}</td>
                <td>
                    <form action="{{ route('softwares.destroy',$software->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('softwares.edit',$software->id) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $softwares->links() !!}
</div>

@stop