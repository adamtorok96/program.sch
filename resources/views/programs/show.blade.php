@extends('layouts.layout')
@section('title', 'Programok')
@section('subtitle', $program->name)
@section('icon', '')
@section('content')
    @include('layouts.title')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Információk</h3>
                </div>
                <table class="table">
                    <tr>
                        <td>Program megnevezése</td>
                        <th class="text-right">{{ $program->name }}</th>
                    </tr>
                    <tr>
                        <td>Időpont</td>
                        <th class="text-right">
                            {{ $program->from->format('Y. m. d. H:i') }} -
                            @if( $program->from->isSameDay($program->to) )
                                {{ $program->to->format('H:i') }}
                            @elseif( $program->from->isSameMonth($program->to) )
                                {{ $program->to->format('m. d. H:i') }}
                            @else
                                {{ $program->to->format('Y. m. d. H:i') }}
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <td>Helyszín</td>
                        <th class="text-right">{{ $program->location }}</th>
                    </tr>
                    @if(isset($program->facebook_event_id))
                        <tr>
                            <td>Facebook esemény</td>
                            <th class="text-right">
                                <a href="https://www.facebook.com/events/{{ $program->facebook_event_id }}" target="_blank">
                                    Facebook
                                </a>
                            </th>
                        </tr>
                    @endif
                    @if(isset($program->webpage))
                        <tr>
                            <td>Weboldal</td>
                            <th class="text-right">{{ $program->webpage }}</th>
                        </tr>
                    @endif
                        <tr>
                            <td colspan="2" class="text-justify">{{ $program->summary }}</td>
                        </tr>
                    @if(isset($program->description))
                        <tr>
                            <td colspan="2" class="text-justify">{{ $program->description }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection