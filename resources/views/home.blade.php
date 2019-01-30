@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->exists('success'))
            <?= session()->get('success') ?>
        @endif
        @if(session()->exists('error'))
            <?= session()->get('error') ?>
        @endif
        <h2>Lista de receitas</h2>
        @foreach($receitas as $data)
        <div class="panel panel-default">
            <div class="panel-body">
                <h4><?= $data->titulo ?></h4>
                <small>Data criação: <?= $data->created_at ?>, Data modificação:  <?= $data->updated_at ?></small>
                <p class="mt-4">Ingredientes: @foreach($data->Ingredientess as $ing) <?= $ing->ingrediente.', ' ?> @endforeach</p>
                <p>Modo de preparo: <?= $data->preparo ?></p>
                <div class="text-right">
                    <form action="/editar" method="post">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input name="id" value="<?= $data->id ?>" hidden>
                        <button type="submit" class="btn btn-info">Editar</button>
                    </form>
                    <form action="/deletar" method="post">
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <input name="id" value="<?= $data->id ?>" hidden>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
