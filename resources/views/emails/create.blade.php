@extends('layouts.layout')

@section('title', 'E-mail')
@section('subtitle', 'Új e-mail küldése')
@section('icon', 'envelope')

@section('content')
    @include('layouts.title-center')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method="post" action="{{ route('emails.store') }}">
                @csrf

                <div class="form-group">
                    <label for="circle">Kör</label>
                    <select name="circle" id="circle" class="form-control">
                        @foreach($circles as $circle)
                            <option value="{{ $circle->id }}" {{ old('circle', Request::get('circle')) == $circle->id ? 'selected' : '' }}>
                                {{ $circle->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="message_html">Üzenet (HTML)</label>
                    <input name="message_html" id="message_html" type="hidden" value="{{ old('message_html') }}">
                    <trix-editor input="message_html" trix-change="trixChange"></trix-editor>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="copy_html" id="copy_html" {{ old('copy_html', true) ? 'checked' : '' }}> HTML üzenet másolása
                    </label>
                </div>

                <div class="form-group">
                    <label for="message">Üzenet</label>
                    <textarea name="message" id="message" rows="3" class="form-control">{{ old('message') }}</textarea>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        document.addEventListener("trix-change", function(event) {
            if( $('#copy_html').is(':checked') === false )
                return;

            var text = event.srcElement.outerText;

            var rows = text.split('\n').length - 1;

            if( rows < 3 )
                rows = 3;

            $("#message").val(text).attr('rows', rows);
        });
    </script>
@endpush