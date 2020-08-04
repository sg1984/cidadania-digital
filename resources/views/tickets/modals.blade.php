<!-- Modal Help -->
<div class="modal fade" id="bugReportHelp" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="bugReportHelpLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bugReportHelpLabel">Tenho uma dúvida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('helpRequest') }}" autocomplete="false">
                @csrf
                <div class="modal-body">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" name="title" required autocomplete="false"/>
                    <label for="description">Por favor, descreva sua dúvida?</label>
                    <textarea class="form-control" name="description" rows="5" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Report Error -->
<div class="modal fade" id="bugReportForm" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reportar erro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('bugReport') }}" autocomplete="false">
                @csrf
                <div class="modal-body">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" name="title" required autocomplete="false"/>
                    <label for="description">Por favor, descreva o erro:</label>
                    <textarea class="form-control" name="description" rows="5" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
