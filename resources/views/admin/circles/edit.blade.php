@extends('admin.layouts.layout')
@section('title', 'Körök')
@section('subtitle', $circle->name . ' szerkesztése')
@section('icon', 'circle-o')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <form method="post" action="{{ route('admin.circles.update', ['circle' => $circle]) }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Kör neve:</label>
                    <input type="text" name="name" id="name" class="form-control" required="required" value="{{ old('name', $circle->name) }}">
                </div>

                <div class="form-group">
                    <label for="resort">Reszort:</label>
                    <select name="resort" id="resort" class="form-control">
                        <option></option>
                        @foreach($resorts as $resort)
                            <option value="{{ $resort->id }}" {{ old('resort', null) == $resort->id }}>{{ $resort->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.circles.show', ['circle' => $circle]) }}" class="btn btn-default">Vissza</a>
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