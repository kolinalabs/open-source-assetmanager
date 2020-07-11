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
        @if (isset($equipment))
            <div class="modal fade" id="newOccurrenceModal" style="padding-right: 12px; display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Nova Ocorrência</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="newOccurrenceForm" action="asdf" class="row">
                                <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">
                                <label for="description">Descrição</label>
                                <textarea
                                    name="description"
                                    class="form-control"
                                    id="description"
                                    required
                                    placeholder="Adicione a descrição da ocorrência"
                                ></textarea>
                                <label for="occurred_at">Data da ocorrência</label>
                                <input type="date" class="form-control" name='occurred_at' id='occurred_at'>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" onclick="occurrenceStore()">Salvar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="m-0 text-dark">Ocorrências</h4>
                            </div>

                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newOccurrenceModal">
                                    <i class="fa fa-plus"></i>
                                    Adicionar Ocorrência
                                </button>
                            </div>
                        </div>

                        <hr>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Data da ocorrência</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($equipment->occurrences as $occurrence)
                                    <tr>
                                        <td>{{ $occurrence->description }}</td>
                                        <td>{{ $occurrence->occurred_at }}</td>
                                        <td>
                                            <button class="btn btn-primary">
                                                Editar
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <div class="alert alert-warning">
                                                Nada a exibir
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop

@section('js')
    <script>
        function occurrenceStore()
        {
            const form = $('#newOccurrenceForm')

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                beforeSend: () => {
                    // swal("Aguarde", {
                    //     icon: "info",
                    // })
                },
                success: () => {
                    swal("Ocorrência criada com sucesso!", {
                        icon: "success"
                    })
                    .then(() => {
                        window.location.reload()
                    })
                },
                error: () => {
                    swal("Falha ao excluir equipamento!", {
                        icon: "error",
                    })
                }
            }
        }
    </script>
@endsection
