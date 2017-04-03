@extends('layouts.layout')
@section('title', 'Programok')
@section('subtitle', $program->circle->name . ' - ' . $program->name)
@section('icon', 'calendar')
@section('content')
    @include('layouts.title')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('layouts.errors')

            <form method="post" action="{{ route('programs.update', ['program' => $program]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="circle">Kör:</label>
                    <input type="text" id="circle" readonly class="form-control" value="{{ $program->circle->name }}">
                </div>

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Program / Nyitás megnevezése: *</label>
                    <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Program / Nyitás megnevezése" value="{{ old('name', $program->name) }}">
                </div>

                <div class="form-group {{ $errors->has('from') ? 'has-error' : '' }}">
                    <label for="from">Mettől: *</label>
                    <input type="datetime-local" name="from" id="from" class="form-control" required="required" placeholder="YYYY-mm-ddTHH:mm:ss" value="{{ old('from', $program->from->format('Y-m-d\TH:i:s')) }}">
                </div>

                <div class="form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                    <label for="to">Meddig:</label>
                    <input type="datetime-local" name="to" id="to" class="form-control" required="required" placeholder="YYYY-mm-ddTHH:mm:ss" value="{{ old('to', $program->to->format('Y-m-d\TH:i:s')) }}">
                </div>

                <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                    <label for="location">Helyszín: *</label>
                    <input type="text" name="location" id="location" class="form-control" required="required" placeholder="Helyszín" value="{{ old('location', $program->location) }}">
                </div>

                <div class="form-group {{ $errors->has('summary') ? 'has-error' : '' }}">
                    <label for="summary">Rövid összefoglaló: *</label>
                    <textarea name="summary" id="summary" maxlength="255" class="form-control" placeholder="Rövid összefoglaló">{{ old('summary', $program->summary) }}</textarea>
                </div>

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description">Leírás / Részletek:</label>
                    <textarea name="description" id="description" rows="5" class="form-control" placeholder="Leírás / Részletek">{{ old('description', $program->description) }}</textarea>
                </div>

                <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                    <label for="website">Weboldal:</label>
                    <input type="text" name="website" id="website" class="form-control" placeholder="Weboldal" value="{{ old('website', $program->website) }}">
                </div>

                <div class="form-group {{ $errors->has('facebook_event_id') ? 'has-error' : '' }}">
                    <label for="facebook_event_id">Facebook esemény azonosító:</label>
                    <div class="input-group">
                        <span class="input-group-addon">https://www.facebook.com/events/</span>
                        <input type="number" name="facebook_event_id" id="facebook_event_id" class="form-control" placeholder="Facebook esemény azonosító" value="{{ old('facebook_event_id', $program->facebook_event_id) }}">
                    </div>
                </div>

                <div class="form-group {{ $errors->has('poster') ? 'has-error' : '' }}">
                    <label for="poster">Plakát:</label>
                    <input type="file" name="poster" id="poster" accept="image/*" class="form-control">
                </div>

                <div class="form-group">
                    <div class="checkbox {{ $errors->has('display_poster') ? 'has-error' : '' }}">
                        <label>
                            <input type="checkbox" name="display_poster" value="1" {{ old('display_poster', $program->display_poster) ? 'checked="checked"' : '' }}>
                            Megjelenjen a rendezvény a heti nagyplakáton?
                        </label>
                    </div>
                    <div class="checkbox {{ $errors->has('display_email') ? 'has-error' : '' }}">
                        <label>
                            <input type="checkbox" name="display_email" value="1" {{ old('display_email', $program->email) ? 'checked="checked"' : '' }}>
                            Megjelenjen a rendezvény a heti PR e-mailben?
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