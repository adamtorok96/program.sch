@extends('admin.layouts.layout')
@section('title', 'Reszortok')
@section('subtitle', 'Új reszort hozzáadésa')
@section('icon', 'circle')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('layouts.errors')

            <form method="post" action="{{ route('admin.resorts.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Reszort neve:</label>
                    <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Reszort neve" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.resorts.index') }}" class="btn btn-default">Vissza</a>
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