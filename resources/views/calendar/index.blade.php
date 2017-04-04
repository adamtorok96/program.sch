@extends('layouts.layout-fluid')
@section('title', 'Naptár')
@section('content')
    <div class="row calendar">
        @each('calendar.day', $days, 'day')
    </div>

    <p class="text-center">{{ $from->format('Y. m. d.') }} - {{ $to->format('Y. m. d.') }}</p>

    <nav>
        <ul class="pager">
            <li>
                <a href="{{ route('calendar.index', ['week' => $prev]) }}">
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i> Előző hét
                </a>
            </li>
            <li>
                <a href="{{ route('calendar.index', ['week' => $next]) }}">
                    Következő hét <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </nav>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
@endpush