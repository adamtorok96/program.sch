<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a href="{{ route('admin.circles.show', ['circle' => $poster->program->circle]) }}">{{ $poster->program->circle->name }}</a> -
                <a href="{{ route('admin.programs.show', ['program' => $poster->program]) }}">{{ $poster->program->name }}</a>
            </h3>
        </div>
        <div class="panel-body">
            <a href="{{ asset($poster->getUrl()) }}" target="_blank">
                <img src="{{ asset($poster->getUrl()) }}" class="img-responsive">
            </a>
        </div>
        <div class="list-group"">
            <a href="{{ route('admin.posters.destroy', ['poster' => $poster]) }}" class="list-group-item list-group-item-danger">Törlés</a>
        </div>
    </div>
</div>