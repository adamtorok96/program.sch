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
                    <tr>
                        <td>Regisztráció időpontja</td>
                        <th class="text-right">{{ $user->created_at->format('Y. m. d. H:i') }}</th>
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
                    @if( $user->isAdmin() )
                        <a href="{{ route('admin.users.demote.admin', ['user' => $user]) }}" class="list-group-item list-group-item-danger">Adminisztrátor jog megvonása</a>
                    @else
                        <a href="{{ route('admin.users.promote.admin', ['user' => $user]) }}" class="list-group-item list-group-item-info">Adminisztrátor jog adása</a>
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
                        <th class="text-center">Körvezető</th>
                        <th class="text-center">PR Menedzser</th>
                    </tr>
                    @foreach($user->circles as $circle)
                        <tr>
                            <td>
                                <a href="{{ route('admin.circles.show', ['circle' => $circle]) }}">
                                    {{ $circle->name }}
                                </a>
                            </td>
                            <td class="text-center">
                                @if( $circle->pivot->leader )
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if( $circle->pivot->pr )
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection