<div class="modal fade" tabindex="-1" role="dialog" id="modal-delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Program törlése</h4>
            </div>
            <div class="modal-body">
                <p>Biztosan törölni akarod a programot ({{ $program->name }})?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Mégse</button>
                <a href="{{ route('admin.programs.destroy', ['program' => $program]) }}" id="btn-delete" class="btn btn-danger">Törlés</a>
            </div>
        </div>
    </div>
</div>