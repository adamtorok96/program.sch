<div class="panel panel-default">
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation">
                <a href="{{ route('admin.programs.index') }}"><i class="fa fa-calendar" aria-hidden="true"></i> Programok</a>
            </li>

            <li role="presentation">
                <a href="{{ route('admin.resorts.index') }}"><i class="fa fa-circle" aria-hidden="true"></i> Resztortok</a>
            </li>

            <li role="presentation">
                <a href="{{ route('admin.circles.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Körök</a>
            </li>

            <li role="presentation">
                <a href="{{ route('admin.locations.index') }}"><i class="fa fa-map-marker" aria-hidden="true"></i> Helyszínek</a>
            </li>

            <li role="presentation">
                <a href="{{ route('admin.users.index') }}"><i class="fa fa-users" aria-hidden="true"></i> Felhasználók</a>
            </li>
        </ul>
    </div>
</div>