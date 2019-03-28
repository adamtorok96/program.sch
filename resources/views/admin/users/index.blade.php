@extends('admin.layouts.layout')

@section('title', 'Felhasználók')
@section('icon', 'users')

@section('content')
    @component('components.bootstrap-table', [
     'search'    => true,
     'url'   => route('admin.ajax.users.index')
 ])
        <th data-field="name" data-sortable="true" data-formatter="PSA.Users.formatName">Név</th>
        <th data-field="email" data-sortable="true" data-formatter="PSA.formatEmail">E-mail cím</th>
    @endcomponent
@endsection