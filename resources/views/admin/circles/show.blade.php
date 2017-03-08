@extends('admin.layouts.layout')
@section('title', 'Körök')
@section('subtitle', $circle->name)
@section('icon', 'circle-o')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Adatok</h3>
                </div>
                <table class="table">
                    <tr>
                        <td>Név</td>
                        <th class="text-right">{{ $circle->name }}</th>
                    </tr>
                    @if( isset($circle->resort) )
                        <tr>
                            <td>Reszort</td>
                            <th class="text-right">
                                <a href="{{ route('admin.resorts.show', ['resort' => $circle->resort]) }}">
                                    {{ $circle->resort->name }}
                                </a>
                            </th>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Műveletek</h3>
                </div>
                <div class="panel-body">
                    <a href="{{ route('admin.circles.edit', ['circle' => $circle]) }}" class="btn btn-block btn-primary">Szerkesztés</a>
                    @if( $circle->active )
                        <a href="{{ route('admin.circles.deactivate', ['circle' => $circle]) }}" class="btn btn-block btn-danger">Elrejt</a>
                    @else
                        <a href="{{ route('admin.circles.activate', ['circle' => $circle]) }}" class="btn btn-block btn-primary">Megjelenít</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tagok</h3>
                </div>
                <table class="table"
                       data-toggle="table"
                       data-pagination="true"
                       data-url="{{ route('admin.ajax.circles.users', ['circle' => $circle]) }}">
                    <thead>
                    <tr>
                        <th data-field="name" data-sortable="true" data-formatter="nameFormatter">Tag neve</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    function nameFormatter(value, row, index) {
        return [
            '<a href="{{ route('admin.users.show', ['user' => null]) }}/' + row['id'] + '">',
            value,
            '</a>'
        ].join('');
    }
</script>
@endpush