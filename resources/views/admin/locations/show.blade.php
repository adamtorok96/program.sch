@extends('admin.layouts.layout')
@section('title', 'Helyszínek')
@section('subtitle', $location->name)
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
                        <th class="text-right">{{ $location->name }}</th>
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
                    <a href="{{ route('admin.locations.edit', ['location' => $location]) }}" class="list-group-item list-group-item-info">Szerkesztés</a>
                </div>
            </div>
        </div>
    </div>
@endsection