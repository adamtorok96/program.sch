@extends('layouts.layout')
@section('title', 'Programok')
@section('subtitle', 'Új program felvétele')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <form method="post" action="{{ route('programs.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label name="name">Program / Nyitás megnevezése:</label>
                    <input type="text" name="name" id="name" class="form-control" required="required" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label name="pr">PR szöveg:</label>
                    <textarea name="pr" id="id" class="form-control" placeholder="PR szöveg">{{ old('pr') }}</textarea>
                </div>

                <div class="form-group">
                    <label name="date">Időpont:*</label>
                    <input type="datetime-local" name="date" id="date" class="form-control" required="required" placeholder="YYYY-mm-ddTHH:mm:ss" value="{{ old('date') }}">
                </div>

                <div class="form-group">
                    <label name="location">Helyszín:</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="Helyszín">
                </div>

                <div class="form-group">
                    <label name="description">Program / Nyitás részletek:</label>
                    <textarea name="description" id="description" rows="5" class="form-control" placeholder="Program / Nyitás részletek">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="display" value="1" checked> Megjelenjen a rendezvény a heti nagyplakáton és a program.sch-n?
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Küldés</button>
                </div>
            </form>

        </div>
    </div>
@endsection