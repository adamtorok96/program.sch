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
        {{--<div class="input-group">--}}
            {{--<span class="input-group-addon">Mettől</span>--}}
            {{--<input type="datetime" name="form" class="form-control">--}}
        {{--</div>--}}
        {{--<div class="input-group">--}}
            {{--<span class="input-group-addon">Meddig</span>--}}
            {{--<input type="datetime" name="form" class="form-control">--}}
        {{--</div>--}}
    </div>
    <table  class="table"
            data-toggle="table"
            data-search="true"
            data-toolbar="#toolbar"
            data-pagination="true"
            data-side-pagination="server"
            data-query-params="PA.programs.queryParams"
            data-url="{{ route('admin.ajax.programs.index') }}">
        <thead>
            <tr>
                <th data-field="name" data-formatter="PA.Programs.formatName">Program megnevezése</th>
                <th data-formatter="PA.Programs.formatCircle">Kör</th>
                <th data-field="date">Dátum</th>
                <th data-formatter="PA.Programs.formatUser">Beküldő</th>
            </tr>
        </thead>
    </table>
@endsection
@push('scripts')
<script type="text/javascript">
    $("#only_poster").change(PA.Programs.reload);
    $("#only_email").change(PA.Programs.reload);
</script>
@endpush