<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    

    <div class="container">
        <h1 style="text-align: center">Editar Curso</h1>
        <form class="row g-3" action="{{ route('cursos.update', $curso->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-12">
                <label for="inputAddress" class="form-label">Nome do Curso</label>
                <input type="text" class="form-control" id="inputAddress" name="nome" required
                    value="{{ $curso->nome_curso }}">
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor"
                    name="titulo_curso" required value="{{ $curso->titulo }}">
            </div>
            <div class="col-12">
                <label for="inputZip" class="form-label">descricao</label>
                <input type="text" class="form-control" id="inputZip" name="desc"required
                    value="{{ $curso->descricao }}">
            </div>
            <div class="col-12">
                <button class="btn btn-primary">Atualizar</button>
            </div>
        </form>
        <a href="{{ route('modulos.index') }}"><button class="btn btn-primary mt-2">Exibir Modulos</button></a>
        <a href="{{ route('cursos.index') }}"><button class="btn btn-primary mt-2">Voltar</button></a>

    </div>
</body>

</html>
