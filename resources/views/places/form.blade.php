@extends('adminlte::page')

@section('title', (isset($place) ? 'Editar' : 'Novo').' Local')

@section('content_header')
    <h1 class="m-0 text-dark">{{ (isset($place) ? 'Editar' : 'Novo') }} Local</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                   <h3 class="card-title">Local</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form
                    action="{{ isset($place) ? route('place.update', ['place' => $place->id ]) : route('place.store') }}"
                    method="post"
                >
                    @csrf
                    @method(isset($place) ? 'PUT' : 'POST')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nome local</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="name"
                                required="required"
                                value="{{ $place->name ?? '' }}"
                                placeholder="Local"
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
@stop
