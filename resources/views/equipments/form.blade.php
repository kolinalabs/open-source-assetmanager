@extends('adminlte::page')

@section('title', (isset($equipment) ? 'Editar' : 'Novo').' Equipamento')

@section('content_header')
    <h1 class="m-0 text-dark">{{ (isset($equipment) ? 'Editar' : 'Novo') }} Equipamento</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                   <h3 class="card-title">Equipamento</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form
                    action="{{ isset($equipment) ? route('equipment.update', ['equipment' => $equipment->id ]) : route('equipment.store') }}"
                    method="post"
                >
                    @csrf
                    @method(isset($equipment) ? 'PUT' : 'POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="model">Nome equipamento</label>
                            <input
                                type="text"
                                name="model"
                                class="form-control"
                                id="model"
                                required="required"
                                value="{{ $equipment->model ?? '' }}"
                                placeholder="Equipamento"
                            >
                            <label for="position">Posição</label>
                            <input
                                type="number"
                                name="position"
                                class="form-control"
                                id="position"
                                required="required"
                                value="{{ $equipment->position ?? '' }}"
                                placeholder="0"
                            >
                            <label for="description">Descrição</label>
                            <textarea
                                name="description"
                                class="form-control"
                                id="description"
                                value="{{ $equipment->description ?? '' }}"
                                placeholder="Adicione a descrição do equipamento"
                            ></textarea>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ route('equipment.index') }}" class="btn btn-info">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@stop
