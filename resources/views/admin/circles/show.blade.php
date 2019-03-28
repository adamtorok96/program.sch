@extends('admin.layouts.layout')

@section('title', 'Körök')
@section('subtitle', $circle->name)
@section('icon', 'circle-o')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Adatok</h3>
                </div>
                <table class="table">
                    <tr>
                        <td>Név</td>
                        <th class="text-right">{{ $circle->name }}</th>
                    </tr>
                    @if( isset($circle->resort) )
                        <tr>
                            <td>Reszort</td>
                            <th class="text-right">
                                <a href="{{ route('admin.resorts.show', ['resort' => $circle->resort]) }}">
                                    {{ $circle->resort->name }}
                                </a>
                            </th>
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
                    <a href="{{ route('admin.circles.edit', ['circle' => $circle]) }}" class="list-group-item list-group-item-info">Szerkesztés</a>
                    @if( $circle->active )
                        <a href="{{ route('admin.circles.deactivate', ['circle' => $circle]) }}" class="list-group-item list-group-item-danger">Elrejt</a>
                    @else
                        <a href="{{ route('admin.circles.activate', ['circle' => $circle]) }}" class="list-group-item list-group-item-info">Megjelenít</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tagok</h3>
                </div>
                @component('components.bootstrap-table', [
                    'url'     => route('admin.ajax.users.circle', ['circle' => $circle])
                ])
                    <th data-field="name" data-sortable="true" data-formatter="PSA.Users.formatName">Név</th>
                @endcomponent
            </div>
        </div>
    </div>
@endsection