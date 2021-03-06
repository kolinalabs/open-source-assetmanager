<div class="row">
    @if (isset($equipment))
        <div class="modal fade" id="occurrenceModal" style="padding-right: 12px; display: none;" aria-modal="true">
            <div class="modal-dialog">

            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="m-0 text-dark">OcorrĂȘncias</h4>
                        </div>

                        <div class="col-6 text-right">
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#occurrenceModal"
                                onclick="retrieveForm('{{ route('occurrence.create', ['equipment' => $equipment->id]) }}')"
                            >
                                <i class="fa fa-plus"></i>
                                Adicionar OcorrĂȘncia
                            </button>
                        </div>
                    </div>

                    <hr>
                    <div id="occurrencesList">
                        @include('equipment.occurrences._list', ['occurrences' => $equipment->occurrences])
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@section('js')
    <script>
        function retrieveForm(url) {
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    $('#occurrenceModal .modal-dialog').html(response)
                },
                error: function () {
                    const errorMessage = `
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Oops</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">Ă</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Falha ao carregar formulĂĄrio de ocorrĂȘncia
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    `
                    $('#occurrenceModal .modal-dialog').html(errorMessage)
                }
            })
        }
        function reloadList() {
            $.ajax({
                url: "{{ route('occurrence.list', ['equipment' => $equipment->id]) }}",
                method: 'GET',
                data: {},
                success: function (response) {
                    $('#occurrencesList').html(response)
                },
                error: function () {
                    const errorMessage = `<div class="alert alert-danger">
                        Falha no carregamento da listagem de ocorrĂȘncias
                    </div>`
                    $('#occurrencesList').html(errorMessage)
                }
            })
        }

        function occurrenceSave()
        {
            const form = $('#occurrenceForm')

            $.ajax({
                url: form.attr('action'),
                method: $('[name=_method]').val(),
                data: form.serialize(),
                beforeSend: () => {
                    // swal("Aguarde", {
                    //     icon: "info",
                    // })
                },
                success: () => {
                    swal("OcorrĂȘncia salva com sucesso!", {
                        icon: "success"
                    })
                    .then(() => {
                        $('#occurrenceModal').modal('hide')
                    })

                    reloadList()
                },
                error: () => {
                    swal("Falha ao salvar ocorrĂȘncia!", {
                        icon: "error",
                    })
                }
            })
        }

        function occurrenceDestroy(url)
        {
            swal({
                title: "Tem certeza que deseja excluir esta ocorrĂȘncia?",
                text: "Esta aĂ§ĂŁo nĂŁo poderĂĄ ser desfeita",
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
                            swal("OcorrĂȘncia excluĂ­da com sucesso!", {
                                icon: "success"
                            })
                            reloadList()
                        },
                        error: () => {
                            swal("Falha ao excluir categoria!", {
                                icon: "error",
                            })
                        }
                    },
                    )
                }
            })
        }
    </script>
@endsection
