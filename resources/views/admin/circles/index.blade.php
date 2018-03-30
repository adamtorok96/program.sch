@extends('admin.layouts.layout')

@section('title', 'Körök')
@section('icon', 'circle-o')

@section('content')
    {{--<div id="toolbar" class="btn-group">
        <a href="{{ route('admin.circles.create') }}" class="btn btn-default">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>--}}
    <table  class="table"
            data-toggle="table"
            data-search="true"
            data-pagination="true"
            data-side-pagination="server"
            data-url="{{ route('admin.ajax.circles.index') }}">
           {{--}} data-toolbar="#toolbar">--}}
        <thead>
            <tr>
                <th data-field="name" data-sortable="true" data-formatter="PA.Circles.formatName">Kör neve</th>
                <th data-field="resort.name" data-sortable="true" data-formatter="PA.Circles.formatResort">Reszort neve</th>
            </tr>
        </thead>
    </table>
@endsection