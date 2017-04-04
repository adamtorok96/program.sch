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
                <div class="list-group">
                    @if( $user->filter )
                        <a href="{{ route('profile.filters.edit') }}" class="list-group-item list-group-item-info">Szűrők beállítása</a>
                        <a href="{{ route('profile.filters.disable') }}" class="list-group-item list-group-item-danger">Programok szűrűsének kikapcsolása</a>
                    @else
                        <a href="{{ route('profile.filters.enable') }}" class="list-group-item list-group-item-info">Programok szűrűsének bekapcsolása</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">iCalendar</h3>
                </div>
                @if( $user->hasCalendar() )
                    <div class="panel-body">
                        <div class="input-group">
                            <input type="text" class="form-control" id="icalc" readonly value="{{ route('calendar.calendar', ['uuid' => $user->calendar->uuid]) }}">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="copy-icalc">
                                    <i class="fa fa-clipboard" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                @else
                    <div class="list-group">
                        <a href="{{ route('profile.calendar.create') }}" class="list-group-item list-group-item-info">iCalendar létrehozása</a>
                    </div>
                @endif
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