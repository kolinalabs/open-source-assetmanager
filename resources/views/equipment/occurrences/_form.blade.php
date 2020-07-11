<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">
            {{ isset($occurrence) ? 'Editar' : 'Nova' }} Ocorrência
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <form
            id="occurrenceForm"
            action="{{ isset($occurrence) ? route('occurrence.update', ['occurrence' => $occurrence->id ]) : route('occurrence.store') }}"
            method="POST"
            class="row"
        >
            @method(isset($occurrence) ? 'PUT' : 'POST')
            @if(isset($equipment))
                <input type="hidden" name="equipment_id" value="{{ $equipment }}">
            @endif
            <label for="occurred_at">Data da ocorrência</label>
            <input type="date" class="form-control" name='occurred_at' id='occurred_at' value="{{ $occurrence->occurred_at ?? '' }}">
            <label for="description">Descrição</label>
            <textarea
                name="description"
                class="form-control"
                id="description"
                required
                placeholder="Adicione a descrição da ocorrência"
            >{{ $occurrence->description ?? "" }}</textarea>
        </form>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="occurrenceSave()">Salvar</button>
    </div>
</div>
<!-- /.modal-content -->
