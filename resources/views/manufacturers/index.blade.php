@extends('adminlte::page')

@section('title', 'Fabricantes')

@section('content_header')
    <h1 class="m-0 text-dark">Fabricantes</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('manufacturer.create') }}" class="btn btn-primary" >Novo</a>
                    <hr>
                    <ul>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome Fabricantes</th>
                                    <th>Editar</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($manufacturers as $manufacturer)
                                <tr>
                                    <td>
                                        {{ $manufacturer->name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('manufacturer.edit', [
                                                'manufacturer' => $manufacturer->id
                                            ]) }}"
                                        class=" btn btn-default btn-xs">
                                            Editar
                                        </a>
                                    </td>
                                    <td>
                                        <!-- Delete Record Form -->
                                        <form
                                            id="{{ $manufacturer->id }}"
                                            onsubmit="return confirm('Tem certeza que quer excluir {{ $manufacturer->name }}?'); "
                                            action="{{ route('manufacturer.destroy', [
                                                'manufacturer' => $manufacturer->id
                                            ]) }}"
                                            method="POST"
                                            class="hidden form-inline"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
