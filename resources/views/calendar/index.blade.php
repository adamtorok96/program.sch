@extends('layouts.layout')
@section('title', 'Naptár')
@section('content')
    <div class="row calendar">
        @each('calendar.day', $days, 'day')
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
@endpush