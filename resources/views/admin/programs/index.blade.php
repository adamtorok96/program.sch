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
    @component('components.bootstrap-table', [
        'search'    => true,
        'toolbar'   => '#toolbar',
        'params'    => 'PSA.Programs.queryParams',
        'url'   => route('admin.ajax.programs.index')
    ])
        <th data-field="name" data-formatter="PSA.Programs.formatName">Program megnevezése</th>
        <th data-field="circle.name" data-formatter="PSA.formatCircle">Kör</th>
        <th data-field="full_date">Dátum</th>
        <th data-field="user.name" data-formatter="PSA.formatUser">Beküldő</th>
    @endcomponent
@endsection

@push('scripts')
<script type="text/javascript">
    $("#only_poster").change(PSA.Programs.reloadTable);
    $("#only_email").change(PSA.Programs.reloadTable);
</script>
@endpush