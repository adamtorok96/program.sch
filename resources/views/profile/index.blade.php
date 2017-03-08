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
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Műveletek</h3>
                </div>
                <div class="panel-body">
                    @if( $user->hasCalendar() )
                        <div class="input-group">
                            <span class="input-group-addon">iCalendar:</span>
                            <input type="text" class="form-control" id="icalc" readonly value="{{ route('calendar', ['uuid' => $user->calendar->uuid]) }}">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="copy-icalc">
                                    <i class="fa fa-clipboard" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    @else
                        <a href="{{ route('profile.calendar.create') }}" class="btn btn-block btn-primary">iCalendar létrehozása</a>
                    @endif
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