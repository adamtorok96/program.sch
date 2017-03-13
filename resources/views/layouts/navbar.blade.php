<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <a class="navbar-brand" href="#">Program.sch</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('index') }}">Naptár</a>
                </li>
                @if( Auth::check() )
                   {{--<li>
                        <a href="{{ route('programs.create') }}">Új program</a>
                    </li>--}}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Új program <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach(\App\Models\Circle::WherePRManager(Auth::user())->get() as $circle)
                                <li>
                                    <a href="{{ route('programs.create', ['circle' => $circle]) }}">{{ $circle->name }}</a>
                                </li>
                            @endforeach
                        </ul>
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