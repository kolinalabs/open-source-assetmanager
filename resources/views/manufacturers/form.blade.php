@extends('adminlte::page')

@section('title', (isset($manufacturer) ? 'Editar' : 'Novo').' Fabricante')

@section('content_header')
    <h1 class="m-0 text-dark">{{ (isset($manufacturer) ? 'Editar' : 'Novo') }} Fabricante</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form
                        action="{{ isset($manufacturer) ? route('manufacturer.update', ['manufacturer' => $manufacturer->id ]) : route('manufacturer.store') }}"
                        method="post"
                    >
                        @csrf
                        @method(isset($manufacturer) ? 'PUT' : 'POST')
                        <label for="name">Fabricante</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            required='required'
                            value="{{ $manufacturer->name ?? '' }}"
                        >
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
