@extends('admin.layouts.layout')

@section('title', 'Körök')
@section('icon', 'circle-o')

@section('content')
    @component('components.bootstrap-table', [
      'search'    => true,
      'toolbar'   => '#toolbar',
      'url'       => route('admin.ajax.circles.index')
  ])
        <th data-field="name" data-sortable="true" data-formatter="PSA.Circles.formatName">Kör neve</th>
        <th data-field="resort.name" data-sortable="true" data-formatter="PSA.formatResort">Reszort neve</th>
    @endcomponent
@endsection