@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Editar Receita</h2>
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post" action="/editsalvar">

                    <input name="id" value="<?= $receita->id ?>" hidden>
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="form-group">
                        <label>Título</label>
                        <input class="form-control" name="titulo" value="<?= $receita->titulo ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Ingredientes</label><br>
                        <div id="lista-ingredientes">
                            @foreach($receita->ingredientess as $key=>$ing)
                                <input type="checkbox" class="checkbox-inline" name="ingredientes[]" value="<?= $ing->ingrediente ?>" checked>
                                <label style="text-align: inherit"><?= $ing->ingrediente ?></label><br>
                            @endforeach
                        </div>
                        <input placeholder="Novo Ingrediente" id="adding" class="form-control" style="max-width: 400px;margin-bottom: 20px"><button href="#" id="mais" class="btn btn-success">Adicionar novo Ingrediente</button><br>
                    </div>
                    <div class="form-group">
                        <label>Modo de preparo</label>
                        <textarea class="form-control" name="preparo" required><?= $receita->preparo ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.onload =  function () {
            document.getElementById("mais").addEventListener("click", function(e){
                e.preventDefault();
                let nome = document.getElementById('adding').value;
                let input = "<input type=\"checkbox\" class=\"checkbox-inline\" name=\"ingredientes[]\" value=\""+nome+"\" checked>\n" +
                    "                        <label  style=\"text-align: inherit\">"+nome+"</label><br>";
                let docs = document.createElement('div');
                docs.innerHTML = input;
                document.getElementById('lista-ingredientes').appendChild(docs);
                document.getElementById('adding').value = '';
            });
        };
    </script>
@endsection
