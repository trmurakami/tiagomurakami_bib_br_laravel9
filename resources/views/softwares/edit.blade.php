<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Editar software</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Editar software</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('softwares.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('softwares.update',$software->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome do software:</strong>
                        <input type="text" name="name" value="{{ $software->name }}" class="form-control"
                            placeholder="Nome do software">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <strong>Categoria:</strong>
                        <input type="text" name="applicationcategory" value="{{ $software->applicationcategory }}"
                            class="form-control" placeholder="Categoria">
                    </div>
                    <div class="form-group">
                        <strong>Descrição:</strong>
                        <textarea type="text" name="description" class="form-control"
                            value="{{ $software->description }}" placeholder="Descrição"></textarea>
                    </div>
                    <div class="form-group">
                        <strong>Mantenedor:</strong>
                        <input type="text" name="maintainer" class="form-control" placeholder="Mantenedor"
                            value="{{ $software->maintainer }}">
                    </div>
                    <div class="form-group">
                        <strong>Licença:</strong>
                        <input type="text" name="license" class="form-control" placeholder="Licença"
                            value="{{ $software->license }}">
                    </div>
                    <div class="form-group">
                        <strong>URL:</strong>
                        <input type="text" name="url" class="form-control" placeholder="URL"
                            value="{{ $software->url }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Enviar</button>
            </div>
        </form>
    </div>
</body>

</html>