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
            data-url="{{ route('admin.ajax.resorts') }}"
            data-toolbar="#toolbar">
        <thead>
        <tr>
            <th data-field="name" data-sortable="true" data-formatter="nameFormatter">Reszort neve</th>
        </tr>
        </thead>
    </table>

@endsection
@push('scripts')
<script type="text/javascript">
    function nameFormatter(value, row, index) {
        return [
            '<a href="{{ route('admin.resorts.show', ['resort' => null]) }}/' + row['id'] + '">',
            value,
            '</a>'
        ].join('');
    }
</script>
@endpush