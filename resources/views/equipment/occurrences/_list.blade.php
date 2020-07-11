
<table class="table">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Data da ocorrência</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($occurrences as $occurrence)
            <tr>
                <td>{{ $occurrence->description }}</td>
                <td>{{ $occurrence->occurred_at->format('d/m/Y') }}</td>
                <td>
                    <button
                        type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#occurrenceModal"
                        onclick="retrieveForm('{{ route('occurrence.edit', ['occurrence' => $occurrence->id]) }}')"
                    >
                        Editar
                    </button>
                    <button
                        class="btn btn-danger"
                        onclick="occurrenceDestroy('{{ route('occurrence.destroy', ['occurrence' => $occurrence->id]) }}')"
                        >
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
