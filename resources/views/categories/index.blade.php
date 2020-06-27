@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
<div class="row">

    <div class="col-6">
        <h1 class="m-0 text-dark">Categorias</h1>
    </div>

    <div class="col-6 text-right">
        <a href="{{ route('category.create') }}" class="btn btn-primary" >
            <i class="fa fa-plus"></i>
            Adicionar Categoria
        </a>
    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listagem de Categorias</h3>
                    <div class="card-tools">
                        <form action="{{ route('category.index') }}" method="get" class="input-group input-group-sm" style="width: 350px;">
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
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    <a>
                                        {{ $category->name }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="{{ route('category.show', $category) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        Visualizar
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('category.edit', $category) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Editar
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="categoriesDelete('{{ route('category.destroy', $category) }}')">
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
                    {{ $categories->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function categoriesDelete(url)
        {
            swal({
                title: "Tem certeza que deseja excluir esta categoria?",
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
                            swal("Categoria excluído com sucesso!", {
                                icon: "success"
                            })
                            .then(() => {
                                window.location.reload()
                            }
                            )
                        },
                        error: () => {
                            swal("Falha ao excluir categoria!", {
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
