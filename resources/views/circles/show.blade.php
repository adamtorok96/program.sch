@extends('layouts.layout')

@section('title', 'Körök')
@section('subtitle', $circle->name)
@section('icon', 'circle')

@section('content')
    @include('layouts.title-center')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Adatok</h3>
                </div>
                <table class="table table-striped">
                    <tr>
                        <td>Név</td>
                        <th class="text-right">{{ $circle->name }}</th>
                    </tr>
                    <tr>
                        <td>Reszort</td>
                        <th class="text-right">{{ $circle->hasResort() ? $circle->resort->name : 'Nincs megadva' }}</th>
                    </tr>
                    <tr>
                        <td>Körvezető</td>
                        <th class="text-right">{{ $circle->hasLeader() ? $circle->leader->name : 'Nincs megadva' }}</th>
                    </tr>
                </table>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="{{ route('circles.programs', ['circle' => $circle]) }}">
                            Utolsó 5 program
                        </a>
                    </h3>
                </div>
                <table class="table table-striped">
                    @foreach($programs as $program)
                        <tr>
                            <td>
                                <a href="{{ route('programs.show', ['program' => $program]) }}">
                                    {{ $program->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="{{ route('circles.newsletterMails', ['circle' => $circle]) }}">
                            Utolsó 5 hírlevél
                        </a>
                    </h3>
                </div>
                <table class="table table-striped">
                    @foreach($newsletters as $newsletter)
                        <tr>
                            <td>
                                <a href="{{ route('newsletterMails.show', ['newsletter' => $newsletter]) }}">
                                    {{ $newsletter->subject }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection