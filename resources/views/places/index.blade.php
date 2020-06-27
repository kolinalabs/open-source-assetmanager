@extends('adminlte::page')

@section('title', 'Locais')

@section('content_header')
<div class="row">

    <div class="col-6">
        <h1 class="m-0 text-dark">Locais</h1>
    </div>

    <div class="col-6 text-right">
        <a href="{{ route('place.create') }}" class="btn btn-primary" >
            <i class="fa fa-plus"></i>
            Adicionar Local
        </a>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listagem de Locais</h3>
                    <div class="card-tools">
                        <form action="{{ route('place.index') }}" method="get" class="input-group input-group-sm" style="width: 350px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 80%">
                                    Nome
                                </th>
                                <th class="text-center" style="width: 19%">
                                    Ações
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($places as $place)
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    <a>
                                        {{ $place->name }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="{{ route('place.show', $place) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Visualizar
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('place.edit', $place) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="placesDelete('{{ route('place.destroy', $place) }}')">
                                        <i class="fas fa-trash">
                                        </i>
                                        Excluir
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
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $places->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function placesDelete(url)
        {
            swal({
                title: "Tem certeza que deseja excluir este local?",
                text: "Esta ação não poderá ser desfeita",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url,
                        method: 'delete',
                        beforeSend: () => {
                            swal("Aguarde", {
                                icon: "info",
                            })
                        },
                        success: () => {
                            swal("Local excluído com sucesso!", {
                                icon: "success"
                            })
                            .then(() => {
                                window.location.reload()
                            }
                            )
                        },
                        error: () => {
                            swal("Falha ao excluir local!", {
                                icon: "error",
                            })
                        }
                    },
                    )
                }
            });
        }
    </script>
@endsection
