<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}">Program.sch</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('index') }}">Naptár</a>
                </li>
                <li>
                    <a href="{{ route('posters.index') }}">Plakátok</a>
                </li>
                @if( Auth::check() )
                    @php($circles = \App\Models\Circle::WherePRManager(Auth::user())->get())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Új program <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('programs.info') }}">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i> Információ
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            @foreach($circles as $circle)
                                <li>
                                    <a href="{{ route('programs.create', ['circle' => $circle]) }}">
                                        <i class="fa fa-calendar-plus-o" aria-hidden="true"></i> {{ $circle->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('api.index') }}">Api</a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if( Auth::check() )
                    @role('admin')
                        <li>
                            <a href="{{ route('admin.index') }}"><i class="fa fa-gear" aria-hidden="true"></i> Adminisztráció</a>
                        </li>
                    @endrole
                    <li>
                        <a href="{{ route('profile.index') }}"><i class="fa fa-user" aria-hidden="true"></i> Profil</a>
                    </li>
                    <li>
                        <a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Kijelentkezés</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('auth.redirect', ['provider' => 'sch']) }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Bejelentkezés</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>