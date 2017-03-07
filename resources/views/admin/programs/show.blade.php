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
                        <td>Időpont</td>
                        <th class="text-right">{{ $program->from->format('Y. m. d. H:i') }}</th>
                    </tr>
                    <tr>
                        <td>Helyszín</td>
                        <th class="text-right">{{ $program->location }}</th>
                    </tr>
                    @if( isset($program->website) )
                        <tr>
                            <td>Weboldal</td>
                            <th><a href="{{ $program->webstie }}" target="_blank">{{ $program->website }}</a></th>
                        </tr>
                    @endif
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
                    <tr>
                        <td colspan="2" class="text-justify">{{ $program->description }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection