@extends('layouts.layout')
@section('title', 'Programok')
@section('subtitle', $circle->name .' - Új program felvétele')
@section('content')
    @include('layouts.title')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('layouts.errors')

            <form method="post" action="{{ route('programs.store', ['circle' => $circle]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="circle">Kör:</label>
                    <input type="text" id="circle" readonly class="form-control" value="{{ $circle->name }}">
                </div>

                <div class="form-group">
                    <label for="name">Program / Nyitás megnevezése:</label>
                    <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Program / Nyitás megnevezése" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="from">Mettől:*</label>
                    <input type="datetime-local" name="from" id="from" class="form-control" required="required" placeholder="YYYY-mm-ddTHH:mm:ss" value="{{ old('from') }}">
                </div>

                <div class="form-group">
                    <label for="to">Meddig:</label>
                    <input type="datetime-local" name="to" id="to" class="form-control" required="required" placeholder="YYYY-mm-ddTHH:mm:ss" value="{{ old('to') }}">
                </div>

                <div class="form-group">
                    <label for="location">Helyszín:</label>
                    <input type="text" name="location" id="location" class="form-control" required="required" placeholder="Helyszín" value="{{ old('location') }}">
                </div>

                <div class="form-group">
                    <label for="summary">Rövid összefoglaló:</label>
                    <textarea name="summary" id="summary" maxlength="255" class="form-control" placeholder="Rövid összefoglaló">{{ old('summary') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description">Leírás / Részletek:</label>
                    <textarea name="description" id="description" rows="5" class="form-control" placeholder="Leírás / Részletek">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="website">Weboldal:</label>
                    <input type="text" name="website" id="website" class="form-control" placeholder="Weboldal" value="{{ old('website') }}">
                </div>

                <div class="form-group">
                    <label for="facebook_event_id">Facebook esemény azonosító:</label>
                    <div class="input-group">
                        <span class="input-group-addon">https://www.facebook.com/events/</span>
                        <input type="number" name="facebook_event_id" id="facebook_event_id" class="form-control" placeholder="Facebook esemény azonosító" value="{{ old('facebook_event_id') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="poster">Plakát:</label>
                    <input type="file" name="poster" id="poster" accept="image/*" class="form-control">
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="display_poster" value="1" {{ old('display_poster', true) ? 'checked="checked"' : '' }}> Megjelenjen a rendezvény a heti nagyplakáton?
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="display_site" value="1" {{ old('display_site', true) ? 'checked="checked"' : '' }}> Megjelenjen a rendezvény a program.sch-n?
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
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $("#from").change(function () {
            var from = new Date($("#from").val());
            from.setHours(from.getHours() + 4);

            var str = from.toISOString();

            $("#to").val(str.substr(0, str.length - 1));
        });

        $( "#location" ).autocomplete({
            source: [
                @foreach($locations as $location)'{{ $location->name }}'@if( !$loop->last ),@endif @endforeach
            ]
        });
    });
</script>
@endpush