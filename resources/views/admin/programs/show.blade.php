@extends('admin.layouts.layout')
@section('title', 'Programok')
@section('subtitle', $program->name)
@section('icon', 'calendar')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Adatok</h3>
                </div>
                <table class="table">
                    <tr>
                        <td>Program megnevezése</td>
                        <th class="text-right">{{ $program->name }}</th>
                    </tr>
                    <tr>
                        <td>Kör</td>
                        <th class="text-right">
                            <a href="{{ route('admin.circles.show', ['circle' => $program->circle]) }}">
                                {{ $program->circle->name }}
                            </a>
                        </th>
                    </tr>
                    <tr>
                        <td>Időpont</td>
                        <th class="text-right">{{ $program->fullDate() }}</th>
                    </tr>
                    <tr>
                        <td>Helyszín</td>
                        <th class="text-right">{{ $program->location }}</th>
                    </tr>
                    @if( isset($program->website) )
                        <tr>
                            <td>Weboldal</td>
                            <th class="text-right"><a href="{{ $program->website }}" target="_blank">Link</a></th>
                        </tr>
                    @endif
                    <tr>
                        <td>Megjelenés - heti nagyplakát</td>
                        <th class="text-right">{{ $program->display_poster ? 'Igen' : 'Nem' }}</th>
                    </tr>
                    <tr>
                        <td>Megjelenés - pr email</td>
                        <th class="text-right">{{ $program->display_email ? 'Igen' : 'Nem' }}</th>
                    </tr>
                    <tr>
                        <td>Beküldő</td>
                        <th class="text-right">
                            <a href="{{ route('admin.users.show', ['user' => $program->user]) }}">
                                {{ $program->user->name }}
                            </a>
                        </th>
                    </tr>
                    <tr>
                        <td>Beküldés időpontja</td>
                        <th class="text-right">{{ $program->created_at->format('Y. m. d. H:i') }}</th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-justify">{{ $program->summary }}</td>
                    </tr>
                    @if( isset($program->description) )
                        <tr>
                            <td colspan="2" class="text-justify">@nl2br($program->description)</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Műveletek</h3>
                </div>
                <div class="list-group">
                    <a href="{{ route('admin.programs.edit', ['program' => $program]) }}" class="list-group-item list-group-item-info">Szerkesztés</a>
                    <button data-toggle="modal" data-target="#modal-delete" class="list-group-item list-group-item-danger">Törlés</button>
                </div>
            </div>
        </div>
        @if( $program->hasPoster() )
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Plakát</h3>
                    </div>
                    <div class="panel-body">
                        <a href="{{ asset($program->poster->getUrl()) }}" target="_blank">
                            <img src="{{ asset($program->poster->getUrl()) }}" class="center-block img-responsive">
                        </a>
                    </div>
                    <duv class="list-group">
                        <a href="{{ route('admin.posters.destroy', ['poster' => $program->poster]) }}" class="list-group-item list-group-item-danger">Törlés</a>
                    </duv>
                </div>
            </div>
        @endif
    </div>
    @include('admin.programs.modals.delete')
@endsection