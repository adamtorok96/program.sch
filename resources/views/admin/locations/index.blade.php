@extends('admin.layouts.layout')

@section('title', 'Helyszínek')
@section('icon', 'map-marker')

@section('content')
    <div id="toolbar" class="btn-group">
        <a href="{{ route('admin.locations.create') }}" class="btn btn-default">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>
    @component('components.bootstrap-table', [
      'search'    => true,
      'toolbar'   => '#toolbar',
      'url'   => route('admin.ajax.locations.index')
  ])
        <th data-field="name" data-sortable="true" data-formatter="PSA.Locations.formatName">Helyszín</th>
    @endcomponent
@endsection
