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
                            <label for="model">Modelo equipamento</label>
                            <input
                                type="text"
                                name="model"
                                class="form-control"
                                id="model"
                                required="required"
                                value="{{ $equipment->model ?? '' }}"
                                placeholder="Equipamento"
                            >
                            <label for="description">Descrição</label>
                            <textarea
                                name="description"
                                class="form-control"
                                id="description"
                                placeholder="Adicione a descrição do equipamento"
                            >{{ $equipment->description ?? '' }}</textarea>
                            <label for="state">Situação</label>
                            <select name="state" id="state" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach (\App\Models\Equipment::STATES as $state)
                                    <option
                                        value="{{ $state }}"
                                        {{ ($equipment->state ?? null) === $state ? 'selected="selected"' : '' }}
                                    >
                                        {{ trans('database.equipment.state.'.$state) }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="patrimony">Patrimônio</label>
                            <input
                                type="text"
                                class="form-control"
                                name="patrimony"
                                id="patrimony"
                                value="{{ $equipment->patrimony ?? '' }}"
                            >
                            <label for="acquisition_value">Valor de aquisição</label>
                            <input
                                type="number"
                                step="0.1"
                                class="form-control"
                                name="acquisition_value"
                                id="acquisition_value"
                                value="{{ $equipment->acquisition_value ?? '' }}"
                            >
                            <label for="place_id">Local</label>
                            <select name="place_id" id="place_id" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach (\App\Models\Place::all() as $place)
                                    <option
                                        value="{{ $place->id }}"
                                        {{ ($equipment->place_id ?? null) === $place->id ? 'selected="selected"' : '' }}
                                    >
                                        {{ $place->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="manufacturer_id">Fabricante</label>
                            <select name="manufacturer_id" id="manufacturer_id" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach (\App\Models\Manufacturer::all() as $manufacturer)
                                    <option
                                        value="{{ $manufacturer->id }}"
                                        {{ ($equipment->manufacturer_id ?? null) === $manufacturer->id ? 'selected="selected"' : '' }}
                                    >
                                        {{ $manufacturer->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="category_id">Categoria</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ ($equipment->category_id ?? null) === $category->id ? 'selected="selected"' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="{{ route('equipment.index') }}" class="btn btn-info">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
        @include('equipment.occurrences._index')
    </div>
@stop
