@extends('admin.layouts.layout')

@section('title', 'Reszortok')
@section('icon', 'circle')

@section('content')
    <div id="toolbar" class="btn-group">
        <a href="{{ route('admin.resorts.create') }}" class="btn btn-default">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>
    <table  class="table"
            data-toggle="table"
            data-search="true"
            data-pagination="true"
            data-side-pagination="server"
            data-url="{{ route('admin.ajax.resorts.index') }}"
            data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="name" data-sortable="true" data-formatter="PA.Resorts.formatName">Reszort neve</th>
            <th data-field="circles_count" class="text-center">Körök száma</th>
        </tr>
        </thead>
    </table>
@endsection
