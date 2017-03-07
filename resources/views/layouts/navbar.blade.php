<nav class="navbar navbar-default">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <a class="navbar-brand" href="#">Porgram.sch</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Naptár</a>
                </li>
                @if( Auth::check() )
                    <li>
                        <a href="{{ route('programs.create') }}">Új program</a>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if( Auth::check() )
                    <li>
                        <a href="{{ route('auth.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Kijelentkezés</a>
                    </li>
                @else
                    @role('admin')
                        <li>
                            <a href="{{ route('admin.index') }}"><i class="fa fa-sign-gear" aria-hidden="true"></i> Adminisztráció</a>
                        </li>
                    @endrole
                    <li>
                        <a href="{{ route('auth.redirect', ['provider' => 'sch']) }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Bejelentkezés</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>