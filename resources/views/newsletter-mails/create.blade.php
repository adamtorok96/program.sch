@extends('layouts.layout')

@section('title', 'Hírlevelek')
@section('subtitle', 'Új - ' . $circle->name)
@section('icon', 'paper-plane')

@section('content')
    @include('layouts.title-center')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.errors') {{-- TODO: REMOVE IT --}}

            <div class="alert alert-info" role="alert">Ezt a levelet <b>{{ $affected }}</b> ember fogja megkapni.</div>

            <form method="post" action="{{ route('newsletterMails.store', ['circle' => $circle]) }}">
                @csrf

                <div class="form-group">
                    <label for="subject">Tárgy</label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required placeholder="Tárgy" class="form-control">
                </div>

                <div class="form-group">
                    <label for="message">Üzenet</label>
                    <textarea name="message" id="message"></textarea>
                    <div id="editSection"></div>
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
            var converter = new Showdown.Converter();

            function md2html(text) {
                return converter.makeHtml(text);
            }

            var editor = new MarkdownEditor({
                container: 'message',
                markdownToHtmlConvertor: md2html
            });
            editor.load();
        });
    </script>
@endpush