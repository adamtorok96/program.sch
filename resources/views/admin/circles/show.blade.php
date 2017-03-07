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
                </div>
            </div>
        </div>
    </div>
@endsection