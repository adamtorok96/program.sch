@extends('admin.layouts.layout')
@section('title', 'Programok')
@section('icon', 'calendar')
@section('content')
    <div id="toolbar" class="btn-group">
        <a href="{{ route('admin.programs.create') }}" class="btn btn-default">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>
    <table  class="table"
            data-toggle="table"
            data-pagination="true"
            data-search="true"
            data-toolbar="#toolbar"
            data-url="{{ route('admin.programs.ajax') }}">
        <thead>
            <tr>
                <th data-field="name" data-sortable="true" data-formatter="nameFormatter">Program megnevezése</th>
                <th data-field="date" data-sortable="true">Dátum</th>
                <th data-field="user_name" data-sortable="true" data-formatter="userFormatter">Beküldő</th>
            </tr>
        </thead>
    </table>
@endsection
@push('scripts')
<script type="text/javascript">
    function nameFormatter(value, row, index) {
        return [
            '<a href="{{ route('admin.programs.show', ['program' => null]) }}/' + row['id'] + '">',
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