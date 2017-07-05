@extends('admin.layouts.layout')
@section('title', 'Programok')
@section('icon', 'calendar')
@section('content')
    <div id="toolbar" class="btn-group">
        <a href="{{ route('admin.programs.create') }}" class="btn btn-default">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default">
                <input type="checkbox" autocomplete="off" id="only_poster">
                Nagyplakát
            </label>
            <label class="btn btn-default">
                <input type="checkbox" autocomplete="off" id="only_email">
                PR e-mail
            </label>
        </div>
    </div>
    <table  class="table"
            data-toggle="table"
            data-search="true"
            data-toolbar="#toolbar"
            data-pagination="true"
            data-side-pagination="server"
            data-query-params="queryParams"
            data-url="{{ route('admin.ajax.programs') }}">
        <thead>
            <tr>
                <th data-field="name" data-formatter="nameFormatter">Program megnevezése</th>
                <th data-field="circle_name" data-formatter="circleFormatter">Kör</th>
                <th data-field="date">Dátum</th>
                <th data-field="user_name" data-formatter="userFormatter">Beküldő</th>
            </tr>
        </thead>
    </table>
@endsection
@push('scripts')
<script type="text/javascript">
    function queryParams(params) {
        if( $("#only_poster").is(":checked") )
            params.only_poster = true;

        if( $("#only_email").is(":checked") )
            params.only_email = true;

        return params;
    }

    function reload() {
        $("table[data-toggle='table']").bootstrapTable('refresh');
    }

    $("#only_poster").change(reload);
    $("#only_email").change(reload);

    function nameFormatter(value, row, index) {
        return [
            '<a href="{{ route('admin.programs.show', ['program' => null]) }}/' + row['id'] + '">',
            value,
            '</a>'
        ].join('');
    }

    function circleFormatter(value, row, index) {
        return [
            '<a href="{{ route('admin.circles.show', ['circle' => null]) }}/' + row['circle_id'] + '">',
            value,
            '</a>'
        ].join('');
    }

    function userFormatter(value, row, index) {
        return [
            '<a href="{{ route('admin.users.show', ['user' => null]) }}/' + row['user_id'] + '">',
            value,
            '</a>'
        ].join('');
    }
</script>
@endpush