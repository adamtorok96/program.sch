@extends('layouts.layout')
@section('title', 'Szűrők')
@section('subtitle', 'Szerkesztés')
@section('icon', 'filter')
@section('content')
    <div class="row">
        @each('filters.resort', $resorts, 'resort')
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("[data-toggle='filter-toggle']").click(function() {
                var item    = $(this);
                var circle  = item.data("circle");
                var active  = item.hasClass("list-group-item-success");

                $.ajax({
                    url: "{{ route('profile.filters.toggle', ['circle' => null]) }}/" + circle,
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