@extends('admin.layouts.layout')
@section('title', 'Helyszínek')
@section('content')
    <table  class="table"
            data-toggle="table"
            data-pagination="true"
            data-search="true"
            data-toolbar="#toolbar"
            data-url="{{ route('admin.ajax.locations') }}">
        <thead>
        <tr>
            <th data-field="name" data-sortable="true" data-formatter="nameFormatter">Név</th>
        </tr>
        </thead>
    </table>
@endsection
@push('scripts')
<script type="text/javascript">
    function nameFormatter(value, row, index) {
        return [
            '<a href="{{ route('admin.locations.show', ['location' => null]) }}/' + row['id'] + '">',
            value,
            '</a>'
        ].join('');
    }
</script>
@endpush