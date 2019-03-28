@extends('admin.layouts.layout')

@section('title', 'Reszortok')
@section('icon', 'circle')

@section('content')
    <div id="toolbar" class="btn-group">
        <a href="{{ route('admin.resorts.create') }}" class="btn btn-default">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>
    @component('components.bootstrap-table', [
       'search'    => true,
       'toolbar'   => '#toolbar',
       'url'   => route('admin.ajax.resorts.index')
   ])
        <th data-field="name" data-sortable="true" data-formatter="PSA.Resorts.formatName">Reszort neve</th>
    @endcomponent
@endsection