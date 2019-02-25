<div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a href="{{ route('programs.show', ['program' => $poster->program]) }}">
                    {{ $poster->program->name }}
                </a>
            </h3>
        </div>
        <div class="panel-body panel-image">
            <a href="{{ $poster->getUrl() }}" target="_blank">
                <img src="{{ $poster->getUrl() }}" alt="{{ $poster->program->name }}" class="img-responsive"/>
            </a>
        </div>
    </div>
</div>