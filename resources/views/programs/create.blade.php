@extends('layouts.layout')

@section('title', 'Programok')
@section('subtitle', $circle->name .' - Új program felvétele')
@section('icon', 'calendar-plus-o')

@section('content')
    @include('layouts.title-center')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.errors')

            <form method="post" action="{{ route('programs.store', ['circle' => $circle]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="circle">Kör:</label>
                    <input type="text" id="circle" readonly class="form-control" value="{{ $circle->name }}">
                </div>

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Program / Nyitás megnevezése: *</label>
                    <input type="text" name="name" id="name" maxlength="40" class="form-control" required="required" placeholder="Program / Nyitás megnevezése" value="{{ old('name') }}">
                </div>

                <div class="form-group {{ $errors->has('from') ? 'has-error' : '' }}">
                    <label for="from">Mettől: *</label>
                    <input type="text" name="from" id="from" class="form-control" required="required" value="{{ old('from') }}">
                </div>

                <div class="form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                    <label for="to">Meddig: *</label>
                    <input type="text" name="to" id="to" class="form-control" required="required" value="{{ old('to') }}">
                </div>

                <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                    <label for="location">Helyszín: *</label>
                    <input type="text" name="location" id="location" class="form-control" required="required" placeholder="Helyszín" value="{{ old('location') }}">
                </div>

                {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                        <div class="form-group {{ $errors->has('summary') ? 'has-error' : '' }}">
                            <label for="summary">Rövid összefoglaló: *</label>
                            <textarea name="summary" id="summary" maxlength="190" class="form-control" required="required" placeholder="Rövid összefoglaló">{{ old('summary') }}</textarea>
                        </div>
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">Részletes leírás: *</label>
                            <textarea name="description" id="description" rows="5" class="form-control" placeholder="Részletes leírás">{{ old('description') }}</textarea>
                        </div>
                    {{--</div>--}}
                {{--</div>--}}


                <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                    <label for="website">Weboldal:</label>
                    <input type="text" name="website" id="website" class="form-control" placeholder="Weboldal" value="{{ old('website') }}">
                </div>

                <div class="form-group {{ $errors->has('facebook_event_id') ? 'has-error' : '' }}">
                    <label for="facebook_event_id">Facebook esemény azonosító:</label>
                    <div class="input-group">
                        <span class="input-group-addon">https://www.facebook.com/events/</span>
                        <input type="number" name="facebook_event_id" id="facebook_event_id" class="form-control" placeholder="Facebook esemény azonosító" value="{{ old('facebook_event_id') }}">
                    </div>
                </div>

                <div class="form-group {{ $errors->has('poster') ? 'has-error' : '' }}">
                    <label for="poster">Plakát:</label>
                    <input type="file" name="poster" id="poster" accept="image/*" class="form-control">
                </div>

                <div class="form-group">
                    <div class="checkbox {{ $errors->has('display_poster') ? 'has-error' : '' }}">
                        <label>
                            <input type="checkbox" name="display_poster" value="1" {{ old('display_poster', false) != null ? 'checked="checked"' : '' }}> Megjelenjen a rendezvény a heti nagyplakáton?
                        </label>
                    </div>
                    <div class="checkbox {{ $errors->has('display_email') ? 'has-error' : '' }}">
                        <label>
                            <input type="checkbox" name="display_email" value="1" {{ old('display_email', false) != null ? 'checked="checked"' : '' }}> Megjelenjen a rendezvény a heti PR e-mailben?
                        </label>
                    </div>
                    {{--}}
                    <div class="checkbox {{ $errors->has('display_site') ? 'has-error' : '' }}">
                        <label>
                            <input type="checkbox" name="display_site" value="1" {{ old('display_site', true) ? 'checked="checked"' : '' }}> Megjelenjen a rendezvény a program.sch-n?
                        </label>
                    </div>--}}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">Küldés</button>
                </div>
            </form>

        </div>
    </div>
@endsection
@include('programs.js')