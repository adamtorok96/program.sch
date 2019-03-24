@extends('layouts.layout')

@section('title', 'Körök')
@section('subtitle', $circle->name . ' - Programok')
@section('icon', 'circle')

@section('content')
    @include('layouts.title-center')

    <div class="panel panel-default">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Program neve</th>
                <th class="text-center">Dátum</th>
            </tr>
            </thead>
            <tbody>
            @foreach($programs as $program)
                <tr>
                    <td>
                        <a href="{{ route('programs.show', ['program' => $program]) }}">
                            {{ $program->name }}
                        </a>
                    </td>
                    <td class="text-center">
                        {{ $program->fullDate() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $programs->links() }}
@endsection