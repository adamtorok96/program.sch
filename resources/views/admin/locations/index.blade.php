@extends('admin.layouts.layout')

@section('title', 'Helyszínek')
@section('icon', 'map-marker')

@section('content')
    <div id="toolbar" class="btn-group">
        <a href="{{ route('admin.locations.create') }}" class="btn btn-default">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>
    <table  class="table"
            data-toggle="table"
            data-search="true"
            data-toolbar="#toolbar"
            data-pagination="true"
            data-side-pagination="server"
            data-url="{{ route('admin.ajax.locations.index') }}">
        <thead>
        <tr>
            <th data-field="name" data-sortable="true" data-formatter="PA.Locations.formatName">Név</th>
        </tr>
        </thead>
    </table>
@endsection
