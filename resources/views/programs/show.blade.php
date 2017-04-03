@extends('layouts.layout')
@section('title', 'Programok')
@section('subtitle', $program->name)
@section('icon', 'calendar')
@section('content')
    @include('layouts.title')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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
                        <td>Kör</td>
                        <th class="text-right">{{ $program->circle->name }}</th>
                    </tr>
                    <tr>
                        <td>Időpont</td>
                        <th class="text-right">
                            {{ $program->fullDate() }}
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
                    @if(isset($program->website))
                        <tr>
                            <td>Weboldal</td>
                            <th class="text-right">
                                <a href="{{ $program->website }}" target="_blank">
                                    Megnyitás
                                </a>
                            </th>
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
                <div class="panel-footer text-right">
                    {{--}}
                    <button type="button" class="btn btn-sm btn-primary">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-primary">
                        <i class="fa fa-google" aria-hidden="true"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-primary">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </button>
                     --}}
                    @role('admin')
                        <a href="{{ route('admin.programs.show', ['program' => $program]) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                        </a>
                    @else
                        @prmanagerat($program->circle)
                            <a href="{{ route('programs.edit', ['program' => $program]) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        @endprmanagerat
                    @endrole()
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
                </div>
            </div>
        @endif
    </div>
    @include('programs.modals.delete')
@endsection
@if( $program->hasPoster() )
    @push('ogs', '<meta property="og:image" content="'. asset($program->poster->getUrl()) .'" />')
    @push('ogs', '<meta property="og:description" content="'. (isset($program->description) ? $program->description : $program->summary) .'" />')
@endif