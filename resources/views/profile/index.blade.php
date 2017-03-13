@extends('layouts.layout')
@section('title', 'Profil')
@section('subtitle', $user->name)
@section('content')
    @include('layouts.title')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Adatok</h3>
                </div>
                <table class="table">
                    <tr>
                        <td>Név</td>
                        <th class="text-right">{{ $user->name }}</th>
                    </tr>
                    <tr>
                        <td>E-mail cím</td>
                        <th class="text-right">{{ $user->email }}</th>
                    </tr>
                    <tr>
                        <td>Regisztráció időpontja</td>
                        <th class="text-right">{{ $user->created_at->format('Y. m. d. H:i') }}</th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Műveletek</h3>
                </div>
                <div class="panel-body">
                    <p>
                        @if( $user->filter )
                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('profile.disable.filters') }}" class="btn btn-block btn-danger">Programok szűrűsének kikapcsolása</a>
                                </div>
                                <div class="btn-group" role="group">
                                    <a href="" class="btn btn-block btn-primary">Szűrők beállítása</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('profile.enable.filters') }}" class="btn btn-block btn-primary">Programok szűrűsének bekapcsolása</a>
                        @endif
                    </p>
                    <p>
                        @if( $user->hasCalendar() )
                            <div class="input-group">
                                <span class="input-group-addon">iCalendar</span>
                                <input type="text" class="form-control" id="icalc" readonly value="{{ route('calendar.calendar', ['uuid' => $user->calendar->uuid]) }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="copy-icalc">
                                        <i class="fa fa-clipboard" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                        @else
                            <a href="{{ route('profile.calendar.create') }}" class="btn btn-block btn-primary">iCalendar létrehozása</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $("#copy-icalc").click(function () {
            $("#icalc").select();
            document.execCommand('copy');
        });
    });
</script>
@endpush