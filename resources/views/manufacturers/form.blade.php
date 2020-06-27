@extends('adminlte::page')

@section('title', (isset($manufacturer) ? 'Editar' : 'Novo').' Fabricante')

@section('content_header')
    <h1 class="m-0 text-dark">{{ (isset($manufacturer) ? 'Editar' : 'Novo') }} Fabricante</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Fabricante</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form"
                    action="{{ isset($manufacturer) ? route('manufacturer.update', ['manufacturer' => $manufacturer->id ]) : route('manufacturer.store') }}"
                    method="post"
                >
                    @csrf
                    @method(isset($manufacturer) ? 'PUT' : 'POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nome fabricante</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="name"
                                required="required"
                                value="{{ $manufacturer->name ?? '' }}"
                                placeholder="Fabricante"
                            >
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
