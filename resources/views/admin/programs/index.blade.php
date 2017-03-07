@extends('admin.layouts.layout')
@section('title', 'Programok')
@section('icon', 'calendar')
@section('content')
    <table  class="table"
            data-toggle="table"
            data-url="{{ route('admin.programs.ajax') }}"
            data-pagination="true"
            data-search="true">
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