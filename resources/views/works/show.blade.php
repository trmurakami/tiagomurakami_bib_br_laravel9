@extends('layouts.layout')

@section('title', 'Biblioteca - ' . $work->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mt-3 mb-3">
                <a class="btn btn-primary" href="{{ route('works.index') }}">Voltar</a>
            </div>
        </div>
    </div>

    <div class="row">
        <x-record :work="$work" />

        @if (Route::has('login'))
        <form action="{{ route('works.destroy',$work->id) }}" method="POST">
            @auth
            <a class="btn btn-primary" href="{{ route('works.edit',$work->id) }}">Editar</a>
            @csrf
            @method('DELETE')
            <!-- Button trigger modal - Delete -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Excluir
            </button>
            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel">Excluir registro</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Esta ação é irreversível. Tem a certeza que pretende excluir o registro?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </div>
                    </div>
                </div>
            </div>
            @endauth
        </form>
        @endif
    </div>
</div>
@endsection