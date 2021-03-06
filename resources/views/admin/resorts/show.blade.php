@extends('admin.layouts.layout')
@section('title', 'Reszortok')
@section('subtitle', $resort->name)
@section('icon', 'circle')
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
                        <th class="text-right">{{ $resort->name }}</th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Műveletek</h3>
                </div>
                <div class="list-group">
                    <a href="{{ route('admin.resorts.edit', ['resort' => $resort]) }}" class="list-group-item list-group-item-info">Szerkesztés</a>
                    <button type="button" class="list-group-item list-group-item-danger">Törlés</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Körök</h3>
                </div>
                <table class="table">
                    <tr>
                        <th>Név</th>
                    </tr>
                    @foreach($resort->circles as $circle)
                        <tr>
                            <td>
                                <a href="{{ route('admin.circles.show', ['circle' => $circle]) }}">
                                    {{ $circle->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection