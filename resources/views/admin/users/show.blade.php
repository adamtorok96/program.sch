@extends('admin.layouts.layout')
@section('title', 'Felhasználók')
@section('subtitle', $user->name)
@section('icon', 'users')
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
                        <th class="text-right">{{ $user->name }}</th>
                    </tr>
                    <tr>
                        <td>E-mail cím</td>
                        <th class="text-right">{{ $user->email }}</th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Műveletek</h3>
                </div>
                <div class="panel-body">
                    @if( $user->isAdmin() )
                        <a href="{{ route('admin.users.demote.admin', ['user' => $user]) }}" class="btn btn-block btn-danger">Adminisztrátor jog megvonása</a>
                    @else
                        <a href="{{ route('admin.users.promote.admin', ['user' => $user]) }}" class="btn btn-block btn-primary">Adminisztrátor jog adása</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }} körei</h3>
                </div>
                <table class="table">
                    <tr>
                        <th>Kör neve</th>
                    </tr>
                    @foreach($user->circles as $circle)
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