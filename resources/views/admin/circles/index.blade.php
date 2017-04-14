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
            data-url="{{ route('admin.ajax.circles') }}">
           {{--}} data-toolbar="#toolbar">--}}
        <thead>
            <tr>
                <th data-field="name" data-sortable="true" data-formatter="nameFormatter">Kör neve</th>
                <th data-field="resort_name" data-sortable="true" data-formatter="resortFormatter">Reszort neve</th>
            </tr>
        </thead>
    </table>
@endsection
@push('scripts')
<script type="text/javascript">
    function nameFormatter(value, row, index) {
        return [
            '<a href="{{ route('admin.circles.show', ['circle' => null]) }}/' + row['id'] + '">',
            value,
            '</a>'
        ].join('');
    }

    function resortFormatter(value, row, index) {
        return [
            '<a href="{{ route('admin.resorts.show', ['resort' => null]) }}/' + row['resort_id'] + '">',
            value,
            '</a>'
        ].join('');
    }
</script>
@endpush