@extends('admin.layouts.layout')

@section('title', 'Felhasználók')
@section('icon', 'users')

@section('content')
    <table  class="table"
            data-toggle="table"
            data-search="true"
            data-toolbar="#toolbar"
            data-pagination="true"
            data-side-pagination="server"
            data-url="{{ route('admin.ajax.users.index') }}">
        <thead>
        <tr>
            <th data-field="name" data-sortable="true" data-formatter="PA.Users.formatName">Név</th>
            <th data-field="email" data-formatter="PA.Users.formatEmail">E-mail cím</th>
        </tr>
        </thead>
    </table>
@endsection