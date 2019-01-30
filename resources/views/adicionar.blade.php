@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Adicionar Receita</h2>
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post" action="/salvar">

                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="form-group">
                        <label>Título</label>
                        <input class="form-control" name="titulo" required>
                    </div>
                    <div class="form-group">
                        <label>Ingredientes</label><br>
                        <div id="lista-ingredientes">
                            <input type="checkbox" class="checkbox-inline" name="ingredientes[]" id="leite" value="leite">
                            <label for="leite" style="text-align: inherit">Leite</label><br>

                            <input type="checkbox" class="checkbox-inline" name="ingredientes[]" id="cafe" value="cafe">
                            <label for="cafe" style="text-align: inherit">Café</label><br>

                            <input type="checkbox" class="checkbox-inline" name="ingredientes[]" id="cenoura" value="cenoura">
                            <label for="cenoura" style="text-align: inherit">Cenoura</label><br>
                        </div>
                        <input placeholder="Novo Ingrediente" id="adding" class="form-control" style="max-width: 400px;margin-bottom: 20px"><button href="#" id="mais" class="btn btn-success">Adicionar novo Ingrediente</button><br>
                    </div>
                    <div class="form-group">
                        <label>Modo de preparo</label>
                        <textarea class="form-control" name="preparo" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
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
