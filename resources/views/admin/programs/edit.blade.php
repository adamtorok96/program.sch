@extends('admin.layouts.layout')
@section('title', 'Programok')
@section('subtitle', $program->name)
@section('icon', 'calendar')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <form method="post" action="{{ route('admin.programs.update', ['program' => $program]) }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Program megnevezése:</label>
                    <input type="text" name="name" id="name" class="form-control" required="required" value="{{ old('name', $program->name) }}">
                </div>

                <div class="form-group">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.programs.show', ['program' => $program]) }}" class="btn btn-default">Vissza</a>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary">Mentés</button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection