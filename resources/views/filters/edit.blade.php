@extends('layouts.layout')

@section('title', 'Szűrők')
@section('subtitle', 'Szerkesztés')
@section('icon', 'filter')

@section('content')
    <div class="row">
        @each('filters.resort', $resorts, 'resort')

        <h2>Egyéb körök</h2>
        @each('filters.circle', $resortlessCircles, 'circle')
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("[data-toggle='filter-toggle']").click(function() {
                var item    = $(this);
                var circle  = item.data("circle");
                var type    = item.data("type");
                var active  = item.hasClass("list-group-item-success");

                var url     = type === "program"
                    ? "{{ route('profile.filters.toggle.program', ['circle' => null]) }}/" + circle
                    : "{{ route('profile.filters.toggle.newsletter', ['circle' => null]) }}/" + circle
                ;

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    }
                }).done(function () {
                    if( active )
                        item.removeClass("list-group-item-success").addClass("list-group-item-danger");
                    else
                        item.removeClass("list-group-item-danger").addClass("list-group-item-success");
                });
            });
        });
    </script>
@endpush