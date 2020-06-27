@extends('adminlte::page')

@section('title', 'Fabricante')

@section('content_header')
    <h1 class="m-0 text-dark">Fabricante</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Dados do Fabricante</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="text-bold col-2">Nome fabricante: </div>
                            <div class="col-10" id="name">
                                {{ $manufacturer->name ?? '' }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-bold col-2">Registro criado em: </div>
                            <div class="col-10" id="name">
                                {{ $manufacturer->created_at->format('d/m/Y H:i:s') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-bold col-2">Registro alterado em: </div>
                            <div class="col-10" id="name">
                                {{ $manufacturer->updated_at->format('d/m/Y H:i:s') }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route('manufacturer.index') }}" class="btn btn-info">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@stop
