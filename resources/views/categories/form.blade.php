@extends('adminlte::page')

@section('title', (isset($category) ? 'Editar' : 'Novo').' Categoria')

@section('content_header')
    <h1 class="m-0 text-dark">{{ (isset($category) ? 'Editar' : 'Novo') }} Categoria</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                   <h3 class="card-title">Categoria</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form
                    action="{{ isset($category) ? route('category.update', ['category' => $category->id ]) : route('category.store') }}"
                    method="post"
                >
                    @csrf
                    @method(isset($category) ? 'PUT' : 'POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nome categoria</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="name"
                                required="required"
                                value="{{ $category->name ?? '' }}"
                                placeholder="Categoria"
                            >
                            <label for="position">Posição</label>
                            <input
                                type="number"
                                name="position"
                                class="form-control"
                                id="position"
                                required="required"
                                value="{{ $category->position ?? '' }}"
                                placeholder="0"
                            >
                            <label for="description">Descrição</label>
                            <textarea
                                name="description"
                                class="form-control"
                                id="description"
                                value="{{ $category->description ?? '' }}"
                                placeholder="Adicione a descrição da categoria"
                            ></textarea>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ route('category.index') }}" class="btn btn-info">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@stop
